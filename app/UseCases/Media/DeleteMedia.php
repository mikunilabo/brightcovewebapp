<?php
declare(strict_types=1);

namespace App\UseCases\Media;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Exceptions\Domain\NotFoundException;

final class DeleteMedia implements UseCaseContract
{
    /** @var RepositoryContract */
    private $repo;

     /**
     * @param RepositoryContract $repo
     * @return void
     */
    public function __construct(RepositoryContract $repo)
    {
        $this->repo = $repo;
    }

    /**
     * string $videoId
     * @return mixed
     */
    public function media(string $videoId)
    {
        if (is_null($model = $this->repo->findById($videoId))) {
            throw new NotFoundException('The media was not found.');
        }

        return $this->repo->findById($videoId);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function excute($args)
    {
        return $this->repo->delete($args['id']);
    }
}
