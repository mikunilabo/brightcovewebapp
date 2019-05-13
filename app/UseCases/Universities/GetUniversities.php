<?php
declare(strict_types=1);

namespace App\UseCases\Universities;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;

final class GetUniversities implements UseCaseContract
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
     * @param array $args
     * @return mixed
     */
    public function excute($args)
    {
        return $this->repo->findAll($args['param']);
    }
}
