<?php
declare(strict_types=1);

namespace App\UseCases\Sports;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Exceptions\Domain\NotFoundException;
use App\Traits\Database\Transactionable;

final class DeleteSport implements UseCaseContract
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
     * @param int $sportId
     * @return mixed
     */
    public function sport(int $sportId)
    {
        if (is_null($model = $this->repo->findById($sportId))) {
            throw new NotFoundException('The sport was not found.');
        }

        return $model;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function excute($args)
    {
        $this->transaction(function () use ($args) {
            $this->repo->delete($args['id']);
        });
    }
}
