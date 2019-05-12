<?php
declare(strict_types=1);

namespace App\UseCases\Leagues;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Exceptions\Domain\NotFoundException;

final class DeleteLeague implements UseCaseContract
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
     * @param int $leagueId
     * @return mixed
     */
    public function league(int $leagueId)
    {
        if (is_null($model = $this->repo->findById($leagueId))) {
            throw new NotFoundException('The league was not found.');
        }

        return $model;
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
