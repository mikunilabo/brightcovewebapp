<?php
declare(strict_types=1);

namespace App\Repositories\Vendor\VideoCloud;

use App\Contracts\Domain\ModelContract;
use App\Contracts\Domain\RepositoryContract;
use App\Model\Media;
use App\Services\Vendor\VideoCloud\VideoCloudClient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use App\Traits\Vendor\VideoCloud\Accessable as VideoCloudAdaptor;

final class MediaRepository implements RepositoryContract
{
    use VideoCloudAdaptor;

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

        $content = $this->requestS3Url($media->id, $sourceName);

        $this->multipartUpload($file->getRealPath(), $content);

        $content = $this->dynamicIngest($media->id, [
            'master_url' => $content['api_request_url'],
            'profile' => config('services.videocloud.video_profile'),
        ]);

        return $media;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function createObject(array $args)
    {
        return $this->createVideo($args['param']);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function updateObject(array $args)
    {
        return $this->updateVideo($args['id'], $args['param']);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function getS3Url(array $args)
    {
        return $this->requestS3Url($args['id'], $args['param']['source']);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function ingestRequest(array $args)
    {
        return $this->dynamicIngest($args['id'], $args['param']);
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
        $this->deleteVideos($id);
    }

    /**
     * @param array $ids
     * @return void
     */
    public function activates($ids = []): void
    {
        foreach ($ids as $id) {
            $this->activateVideo($id);
        }
    }

    /**
     * @param array $ids
     * @return void
     */
    public function deletes($ids = []): void
    {
        $this->deleteVideos($ids);
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
        $contents = collect();

        foreach ($this->getVideos($args) as $content) {
            $contents->push(new Media($content));
        }

        return $contents;
    }

    /**
     * @param mixed $id
     * @return Collection
     */
    public function ingestjobs($id): Collection
    {
        return collect($this->getStatusOfIngestJobs($id));
    }
}
