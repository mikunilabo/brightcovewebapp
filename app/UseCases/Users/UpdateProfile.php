<?php
declare(strict_types=1);

namespace App\UseCases\Users;

use App\Contracts\Domain\UseCaseContract;
use App\Traits\Database\Transactionable;

final class UpdateProfile implements UseCaseContract
{
    use Transactionable;

     /**
     * @return void
     */
    public function __construct()
    {
        //
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

            if (! empty($param['password'])) {
                $entity->password = bcrypt($param['password']);
            }

            $entity->sync($related = 'leagues', empty($param[$related]) ? [] : [$param[$related]]);
            $entity->sync($related = 'sports', empty($param[$related]) ? [] : $param[$related]);
            $entity->sync($related = 'universities', empty($param[$related]) ? [] : [$param[$related]]);

            return $entity->update($param);
        });
    }
}
