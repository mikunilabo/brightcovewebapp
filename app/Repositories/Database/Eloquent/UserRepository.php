<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Model\Eloquent\User;

final class UserRepository extends EloquentRepository
{
    /**
     * @param User $eloquent
     */
    public function __construct(User $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param mixed $builder
     * @param array $args
     * @return mixed
     */
    public function build($builder, $args = [])
    {
        $builder->with([
            'role',
            'loginHistories',
        ]);

        $builder->latest();

        return $builder;
    }
}
