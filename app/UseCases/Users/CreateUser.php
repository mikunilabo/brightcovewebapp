<?php
declare(strict_types=1);

namespace App\UseCases\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Traits\Database\Transactionable;

final class CreateUser implements UseCaseContract
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
    public function excute($args)
    {
        return $this->transaction(function () use ($args) {
            $entity = $this->repo->create($args['param']);
            $entity->sync($related = 'leagues', empty($args['param'][$related]) ? [] : [$args['param'][$related]]);
            $entity->sync($related = 'sports', empty($args['param'][$related]) ? [] : $args['param'][$related]);
            $entity->sync($related = 'universities', empty($args['param'][$related]) ? [] : [$args['param'][$related]]);

            return $entity;
        });
    }
}
