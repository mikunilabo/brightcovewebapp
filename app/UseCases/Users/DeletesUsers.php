<?php
declare(strict_types=1);

namespace App\UseCases\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Traits\Database\Transactionable;

final class DeletesUsers implements UseCaseContract
{
    use Transactionable;

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
    public function users(array $args = [])
    {
        return $this->repo->findByIds($args['ids']);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function excute($args)
    {
        return $this->transaction(function () use ($args) {
            return $this->repo->deletes($args['items']);
        });
    }
}
