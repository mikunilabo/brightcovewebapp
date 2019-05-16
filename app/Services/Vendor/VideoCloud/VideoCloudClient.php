<?php
declare(strict_types=1);

namespace App\Services\Vendor\VideoCloud;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class VideoCloudClient
{
    /** @var Client */
    private $client;

    /** @var string */
    private $accountId;

    /** @var string */
    private $clientId;

    /** @var string */
    private $clientSecret;

    /** @var string */
    private $accessToken;

    const CMS_URL    = 'https://cms.api.brightcove.com';
    const INGEST_URL = 'https://ingest.api.brightcove.com';
    const OAUTH_URL  = 'https://oauth.brightcove.com';

    /**
     * @param string $accountId
     * @param string $clientId
     * @param string $clientSecret
     * @return void
     */
    public function __construct(
        $accountId,
        $clientId,
        $clientSecret
    ) {
        $this->client = new Client;
        $this->accountId = $accountId;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return ResponseInterface
     */
    public function authenticate(): ResponseInterface
    {
        return $this->client->post(sprintf('%s/v4/access_token', self::OAUTH_URL), [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'auth' => [
                $this->clientId,
                $this->clientSecret,
            ],
            'query' => [
                'grant_type' => 'client_credentials',
            ],
        ]);
    }

    /**
     * @param array $args
     * @return ResponseInterface
     */
    public function createVideo(array $args = []): ResponseInterface
    {
        return $this->client->post(sprintf('%s/v1/accounts/%s/videos', self::CMS_URL, $this->accountId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
            'json' => $args,
        ]);
    }

    /**
     * @param string $videoId
     * @param array $args
     * @return ResponseInterface
     */
    public function updateVideo(string $videoId, array $args = []): ResponseInterface
    {
        return $this->client->patch(sprintf('%s/v1/accounts/%s/videos/%s', self::CMS_URL, $this->accountId, $videoId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
            'json' => $args,
        ]);
    }

    /**
     * @param string $videoId
     * @param string $sourceName
     * @return ResponseInterface
     */
    public function getTemporaryS3UrlsToUploadVideo(string $videoId, string $sourceName): ResponseInterface
    {
        return $this->client->get(sprintf('%s/v1/accounts/%s/videos/%s/upload-urls/%s', self::INGEST_URL, $this->accountId, $videoId, $sourceName), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ]);
    }

    /**
     * @param string $videoId
     * @param array $args
     * @return ResponseInterface
     */
    public function dynamicIngest(string $videoId, array $args = []): ResponseInterface
    {
        return $this->client->post(sprintf('%s/v1/accounts/%s/videos/%s/ingest-requests', self::INGEST_URL, $this->accountId, $videoId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
            'json' => $args,
        ]);
    }

    /**
     * @param string $videoId
     * @return ResponseInterface
     */
    public function getStatusOfIngestJobs(string $videoId): ResponseInterface
    {
        return $this->client->get(sprintf('%s/v1/accounts/%s/videos/%s/ingest_jobs', self::CMS_URL, $this->accountId, $videoId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ]);
    }

    /**
     * @param string $videoId
     * @return ResponseInterface
     */
    public function getVideo(string $videoId): ResponseInterface
    {
        return $this->client->get(sprintf('%s/v1/accounts/%s/videos/%s', self::CMS_URL, $this->accountId, $videoId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ]);
    }

    /**
     * @param string $videoId
     * @return ResponseInterface
     */
    public function getVideos(array $args = []): ResponseInterface
    {
        return $this->client->get(sprintf('%s/v1/accounts/%s/videos', self::CMS_URL, $this->accountId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
            'query' => $args,
        ]);
    }

    /**
     * @param string $videoIds
     * @return ResponseInterface
     */
    public function deleteVideos(string $videoIds): ResponseInterface
    {
        return $this->client->delete(sprintf('%s/v1/accounts/%s/videos/%s', self::CMS_URL, $this->accountId, $videoIds), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ]);
    }

    /**
     * @return ResponseInterface
     */
    public function getCustomFields(): ResponseInterface
    {
        return $this->client->get(sprintf('%s/v1/accounts/video_fields', self::CMS_URL, $this->accountId), [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ]);
    }

    /**
     * @param string|null $accountId
     * @return string|null
     */
    public function accountId(string $accountId = null): ?string
    {
        if (! is_null($accountId)) {
            $this->accountId = $accountId;
        }

        return $this->accountId;
    }

    /**
     * @param string|null $clientId
     * @return string|null
     */
    public function clientId(string $clientId = null): ?string
    {
        if (! is_null($clientId)) {
            $this->clientId = $clientId;
        }

        return $this->clientId;
    }

    /**
     * @param string|null $clientSecret
     * @return string|null
     */
    public function clientSecret(string $clientSecret = null): ?string
    {
        if (! is_null($clientSecret)) {
            $this->clientSecret = $clientSecret;
        }

        return $this->clientSecret;
    }

    /**
     * @param string|null $accessToken
     * @return string|null
     */
    public function accessToken(string $accessToken = null): ?string
    {
        if (! is_null($accessToken)) {
            $this->accessToken = $accessToken;
        }

        return $this->accessToken;
    }
}
