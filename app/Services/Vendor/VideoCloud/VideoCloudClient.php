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
    private $videoProfile;

    /** @var string */
    private $callbackUrl;

    /** @var string */
    private $accessToken;

    const CMS_URL    = 'https://cms.api.brightcove.com';
    const INGEST_URL = 'https://ingest.api.brightcove.com';
    const OAUTH_URL  = 'https://oauth.brightcove.com';

    /**
     * @param string $accountId
     * @param string $clientId
     * @param string $clientSecret
     * @param string|null $videoProfile
     * @param string|null $callbackUrl
     * @return void
     */
    public function __construct(
        $accountId,
        $clientId,
        $clientSecret,
        $videoProfile = null,
        $callbackUrl = null
    ) {
        $this->client = new Client;
        $this->accountId = $accountId;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->videoProfile = $videoProfile;
        $this->callbackUrl = $callbackUrl;
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
            'http_errors' => false,
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
            ],
            'http_errors' => false,
            'json' => $args,
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
     * @param string|null $videoProfile
     * @return string|null
     */
    public function videoProfile(string $videoProfile = null): ?string
    {
        if (! is_null($videoProfile)) {
            $this->videoProfile = $videoProfile;
        }

        return $this->videoProfile;
    }

    /**
     * @param string|null $callbackUrl
     * @return string|null
     */
    public function callbackUrl(string $callbackUrl = null): ?string
    {
        if (! is_null($callbackUrl)) {
            $this->callbackUrl = $callbackUrl;
        }

        return $this->callbackUrl;
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
