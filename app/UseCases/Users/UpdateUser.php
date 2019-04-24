<?php
declare(strict_types=1);

namespace App\UseCases\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Contracts\Domain\RepositoryContract;
use App\Traits\Database\Transactionable;

final class UpdateUser implements UseCaseContract
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
        /**
         * TODO Not found exception
         */

        return $this->repo->findById($userId);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function excute($args)
    {
        return $this->transaction(function () use ($args) {
            $entity = $args['entity'];
            $param = $args['param'];

            $entity->sync($related = 'leagues', empty($param[$related]) ? [] : [$param[$related]]);
            $entity->sync($related = 'sports', empty($param[$related]) ? [] : $param[$related]);
            $entity->sync($related = 'universities', empty($param[$related]) ? [] : [$param[$related]]);

            return $entity->update($param);
        });
    }
}
