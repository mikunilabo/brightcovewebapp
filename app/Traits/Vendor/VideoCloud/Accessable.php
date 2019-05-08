<?php
declare(strict_types=1);

namespace App\Traits\Vendor\VideoCloud;

use App\Exceptions\Domain\UnexpectedResponseException;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Psr\Http\Message\ResponseInterface;

trait Accessable
{
    /**
     * @param array $args
     * @return mixed
     */
    private function createVideo(array $args = [])
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->createVideo([
            'name' => $args['name'],// required, 1 <= 255
//             'custom_fields' => [
//                 'date' => now()->format('Ymd'),// YYYY-MM-DD
//                 'rightholder' => 'hoge',
//                 'tournament' => 'hoge',
//                 'uuid' => $args['uuid'],
//             ],
            'description' => 'description',// 0 <= 255 ?
            'long_description' => 'some freewords',// 0 <= 5000
            'schedule' => [
                'starts_at' => now()->format('c'),// ISO-8601
                'ends_at' => now()->format('c'),// ISO-8601
            ],
            'state' => 'INACTIVE',// or ACTIVE
            'tags' => [
                'test',
            ],
        ]);

        $this->httpStatusCode($response, [201]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @param array $args
     * @return mixed
     */
    private function dynamicIngest(string $videoId, array $args = [])
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->dynamicIngest($videoId, [
            'master' => [
                'url' => $args['master_url'],
            ],
//             'callbacks' => [],
            'capture-images' => true,// default true
            'profile' => $args['profile'],
        ]);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @param string $sourceName
     * @return mixed
     */
    private function requestS3Url(string $videoId, string $sourceName)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->getTemporaryS3UrlsToUploadVideo($videoId, $sourceName);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @return mixed
     */
    private function getVideo(string $videoId)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->getVideo($videoId);

        $this->httpStatusCode($response, [200, 404]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $args
     * @return mixed
     */
    private function getVideos(array $args = [])
    {
        $this->auth();

        $q = $this->queries($args);

        /** @var ResponseInterface $response */
        $response = $this->client->getVideos($q);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @return mixed
     */
    private function getStatusOfIngestJobs(string $videoId)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->getStatusOfIngestJobs($videoId);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string|array $videoIds
     * @return mixed
     */
    private function deleteVideos($videoIds)
    {
        $this->auth();

        $videoIds = is_array($videoIds) ? $videoIds : [$videoIds];

        /** @var ResponseInterface $response */
        $response = $this->client->deleteVideos(implode(',', $videoIds));

        $this->httpStatusCode($response, [204]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $filepath
     * @param array $args
     * @return mixed
     */
    private function multipartUpload(string $filepath, array $args)
    {
        /** @var S3Client $s3Client */
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => [
                'key' => $args['access_key_id'],
                'secret' => $args['secret_access_key'],
                'token' => $args['session_token'],
            ],
        ]);

        $params = [
            'bucket' => $args['bucket'],
            'key' => $args['object_key'],
        ];

        /** @var MultipartUploader $uploader */
        $uploader = new MultipartUploader($s3Client, $filepath, $params);

        try {
            $response = $uploader->upload();
        } catch (MultipartUploadException $e) {
            throw new UnexpectedResponseException($e->getMessage());
        }

        return $response;
    }

    /**
     * @return void
     */
    private function auth(): void
    {
        if (! is_null($accessToken = session('videocloud.access_token')) && session('videocloud.expires_on', 0) > time()) {
            $this->client->accessToken($accessToken);
            return;
        }

        /** @var ResponseInterface $response */
        $response = $this->client->authenticate();

        $this->httpStatusCode($response, [200]);

        $content = json_decode($response->getBody()->getContents(), true);
        $this->client->accessToken($content['access_token']);

        session([
            'videocloud.access_token' => $content['access_token'],
            'videocloud.expires_on' => (int)$content['expires_in'] + time(),
        ], (int)$content['expires_in']);
    }

    /**
     * @param ResponseInterface $response
     * @param array $allows
     * @throws UnexpectedResponseException
     * @return void
     */
    private function httpStatusCode(ResponseInterface $response, array $allows = []): void
    {
        if (! in_array($response->getStatusCode(), $allows, true)) {
            throw new UnexpectedResponseException(sprintf('API response status code is unexpected. [allowd: %s] [returned: %s]', implode(',', $allows), $response->getStatusCode()));
        }
    }

    /**
     * @param array $args
     * @return array
     */
    private function queries(array $args = []): array
    {
        $q = [];

        // ids
        if (array_key_exists('ids', $args) && is_array($args['ids'])) {
            $q[] = collect($args['ids'])->map(function ($item) {
                return sprintf('id:%s', $item);
            })->implode(' ');
        }

        // state
//         $q[] = '+state:ACTIVE,INACTIVE';

        // uuid
//         $q[] = '+custom_fields:uuid';

        return [
            'q' => implode(' ', $q),
        ];
    }
}
