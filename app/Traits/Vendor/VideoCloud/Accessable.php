<?php
declare(strict_types=1);

namespace App\Traits\Vendor\VideoCloud;

use App\Exceptions\Domain\UnexpectedResponseException;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Illuminate\Support\Carbon;
use Psr\Http\Message\ResponseInterface;
use Util;

trait Accessable
{
    /**
     * @param array $args
     * @return mixed
     */
    private function createVideo(array $args = [])
    {
        $this->auth();

        $params = $this->cmsParams($args);

        /** @var ResponseInterface $response */
        $response = $this->client->createVideo($params);

        $this->httpStatusCode($response, [201]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @param array $args
     * @return mixed
     */
    private function updateVideo(string $videoId, array $args = [])
    {
        $this->auth();

        $params = $this->cmsParams($args);

        /** @var ResponseInterface $response */
        $response = $this->client->updateVideo($videoId, $params);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     *
     * @param array $args
     * @return array
     */
    private function cmsParams(array $args = []): array
    {
        $params = [
            'name' => $args['name'],// required, 1 <= 255
        ];

        /**
         * General
         */
        if (array_key_exists($key = 'description', $args)) {
            $params[$key] = $args[$key];// 0 <= 248
        }

        if (array_key_exists($key = 'long_description', $args)) {
            $params[$key] = $args[$key];// 0 <= 5000
        }

        if (array_key_exists($key = 'state', $args)) {
            $params[$key] = $args[$key];// ACTIVE or INACTIVE
        }

        /**
         * Custom Fields
         */
        // if (array_key_exists($key = 'date', $args)) {
        //     $params['custom_fields'][$key] = $args[$key];// YYYY/MM/DD
        // }
        //
        // if (array_key_exists($key = 'rightholder', $args)) {
        //     $params['custom_fields'][$key] = $args[$key];
        // }
        //
        // if (array_key_exists($key = 'tournament', $args)) {
        //     $params['custom_fields'][$key] = $args[$key];
        // }
        //
        if (array_key_exists($key = 'uuid', $args)) {
            $params['custom_fields'][$key] = $args[$key];
        }

        /**
         * Schedules
         */
        if (array_key_exists($key = 'starts_at', $args)) {
            $params['schedule'][$key] = is_null($args[$key]) ? null : Carbon::parse($args[$key])->format('c');// ISO-8601
        }

        if (array_key_exists($key = 'ends_at', $args)) {
            $params['schedule'][$key] = is_null($args[$key]) ? null : Carbon::parse($args[$key])->format('c');// ISO-8601
        }

        /**
         * Tags
         */
        $leagues = empty($args['leagues']) ? [] : $args['leagues'];
        $universities = empty($args['universities']) ? [] : $args['universities'];
        $sports = empty($args['sports']) ? [] : $args['sports'];
        $params['tags'] = array_values(array_filter(array_merge($leagues, $universities, $sports), 'strlen'));

        return $params;
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
        $response = $this->client->getTemporaryS3UrlsToUploadVideo($videoId, \Util::strimWithExtension($sourceName, 50));

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
     * @param string $videoId
     * @return mixed
     */
    private function activateVideo($videoId)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->updateVideo($videoId, [
            'state' => 'ACTIVE',
        ]);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @return mixed
     */
    private function deactivateVideo($videoId)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->updateVideo($videoId, [
            'state' => 'INACTIVE',
        ]);

        $this->httpStatusCode($response, [200]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $videoId
     * @return mixed
     */
    private function deleteVideo(string $videoId)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->deleteVideos($videoId);

        $this->httpStatusCode($response, [204]);

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
        if (! is_null($accessToken = session('videocloud.access_token')) && (session('videocloud.expires_on', 0) - 30) > time()) {
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
            $id = Util::orderedUuid();
            $message = sprintf('The response status code from VideoCloud API is unexpected. [allowd: %s] [returned: %s] [log_id: %s]', implode(',', $allows), $response->getStatusCode(), $id);
            $content = $response->getBody()->getContents();
            logger()->error($message, (array)$response);

            throw new UnexpectedResponseException(sprintf('%s [response: %s]', $message, $content), $response->getStatusCode());
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
        if (array_key_exists('uuid', $args)) {
            $q[] = sprintf('+custom_fields:%s', $args['uuid']);
        }

        return [
            'q' => implode(' ', $q),
        ];
    }
}
