<?php
declare(strict_types=1);

namespace App\Repositories\Vendor\VideoCloud;

use App\Contracts\Domain\ModelContract;
use App\Contracts\Domain\RepositoryContract;
use App\Services\Vendor\VideoCloud\VideoCloudClient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
            config('services.videocloud.client_secret'),
            config('services.videocloud.video_profile')
        );
    }

    /**
     * @test
     * @param array $args
     */
    public function test(array $args = [])
    {
        $this->auth();

        /*
        $response = $this->client->createVideo([
            'name' => $args['title'],// required, 1 <= 255
            'custom_fields' => [
                'date' => now()->format('Ymd'),// YYYY-MM-DD
                'rightholder' => 'hoge',
                'tournament' => 'hoge',
                'uuid' => $args['uuid'],
            ],
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

        $content = json_decode($response->getBody()->getContents(), true);
        */

        dd($content);
    }

    /**
     * @return void
     */
    public function auth(): void
    {
        if (! is_null($accessToken = session('videocloud.access_token')) && session('videocloud.expires_on', 0) > time()) {
            $this->client->accessToken($accessToken);
            dump('skip');
            return;
        }

        $response = $this->client->authenticate();
        $content = json_decode($response->getBody()->getContents(), true);
        $this->client->accessToken($content['access_token']);

        session([
            'videocloud.access_token' => $content['access_token'],
            'videocloud.expires_on' => (int)$content['expires_in'] + time(),
        ], (int)$content['expires_in']);
    }

    /**
     * @param mixed $builder
     * @return mixed
     */
//     public function build($builder)
//     {
//         return $builder;
//     }

    /**
     * @param array $args
     * @return ModelContract
     */
    public function create(array $args = []): ModelContract
    {
        //
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
        //
    }

    /**
     * @param mixed $id
     * @return ModelContract|null
     */
    public function findById($id): ?ModelContract
    {
        //
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
}
