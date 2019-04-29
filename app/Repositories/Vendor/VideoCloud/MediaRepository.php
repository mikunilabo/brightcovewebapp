<?php
declare(strict_types=1);

namespace App\Repositories\Vendor\VideoCloud;

use App\Contracts\Domain\ModelContract;
use App\Contracts\Domain\RepositoryContract;
use App\Exceptions\Domain\UnexpectedResponseException;
use App\Model\Media;
use App\Services\Vendor\VideoCloud\VideoCloudClient;
use Aws\Exception\MultipartUploadException;
use Aws\S3\MultipartUploader;
use Aws\S3\S3Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

final class MediaRepository implements RepositoryContract
{
    /** @var VideoCloudClient */
    private $client;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->client = new VideoCloudClient(
            config('services.videocloud.account_id'),
            config('services.videocloud.client_id'),
            config('services.videocloud.client_secret')
        );
    }

    /**
     * @param mixed $builder
     * @return mixed
     */
    public function build($builder)
    {
        return $builder;
    }

    /**
     * @param array $args
     * @return ModelContract
     */
    public function create(array $args = []): ModelContract
    {
        $media = new Media($this->createVideo($args['param']));

        /** @var UploadedFile $file */
        $file = $args['param']['video_file'];
        $sourceName = $file->getClientOriginalName();// TODO except url chars.

        $content = $this->getS3Url($media->id, $sourceName);

        $this->multipartUpload($file->getRealPath(), $content);

        $content = $this->ingestRequest($media->id, [
            'url' => $content['api_request_url'],
            'profile' => config('services.videocloud.video_profile'),
        ]);

        return $media;
    }

    /**
     * @param mixed $id
     * @param array $args
     * @return bool
     */
    public function update($id, array $args = []): bool
    {
        //
    }

    /**
     * @param mixed $id
     * @return void
     */
    public function delete($id): void
    {
        $this->deleteVideo($id);
    }

    /**
     * @param mixed $id
     * @return ModelContract|null
     */
    public function findById($id): ?ModelContract
    {
        $model = null;
        $content = $this->getVideo($id);

        if (! empty($content['id'])) {
            $model = new Media($content);
        }

        return $model;
    }

    /**
     * @param array $args
     * @param bool $paginate
     * @return Collection|LengthAwarePaginator
     */
    public function findAll(array $args = [], $paginate = false)
    {
        //
    }

    /**
     * @param mixed $id
     * @return Collection
     */
    public function ingestjobs($id): Collection
    {
        return collect($this->getStatusOfIngestJobs($id));
    }

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
    private function ingestRequest(string $videoId, array $args = [])
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->ingestRequest($videoId, [
            'master' => [
                'url' => $args['url'],
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
    private function getS3Url(string $videoId, string $sourceName)
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
    private function deleteVideo(string $videoId)
    {
        $this->auth();

        /** @var ResponseInterface $response */
        $response = $this->client->deleteVideo($videoId);

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

        $uploader = new MultipartUploader($s3Client, $filepath, $params);
        $response = $uploader->upload();

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
            throw new UnexpectedResponseException('API response status code is unexpected.');
        }
    }
}
