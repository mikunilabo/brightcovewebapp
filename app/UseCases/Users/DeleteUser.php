<?php
declare(strict_types=1);

namespace App\UseCases\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Exceptions\Domain\NotFoundException;
use App\Traits\Database\Transactionable;

final class DeleteUser implements UseCaseContract
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
     * string $userId
     * @return mixed
     */
    public function user(string $userId)
    {
        if (is_null($model = $this->repo->findById($userId))) {
            throw new NotFoundException('The account was not found.');
        }

        return $model;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function excute($args)
    {
        return $this->transaction(function () use ($args) {
            return $args['entity']->delete();
        });
    }
}
