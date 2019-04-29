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
}
