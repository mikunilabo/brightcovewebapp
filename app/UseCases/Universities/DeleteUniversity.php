<?php
declare(strict_types=1);

namespace App\UseCases\Universities;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Exceptions\Domain\NotFoundException;
use App\Traits\Database\Transactionable;

final class DeleteUniversity implements UseCaseContract
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
     * @param int $leagueId
     * @return mixed
     */
    public function league(int $leagueId)
    {
        if (is_null($model = $this->repo->findById($leagueId))) {
            throw new NotFoundException('The university was not found.');
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
