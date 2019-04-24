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
     * @return mixed
     */
    public function build($builder)
    {
        $builder->with([
            'role',
            'loginHistories' => function ($query) {
                $query->latest()->limit(1);
            },
        ]);

        $builder->latest();

        return $builder;
    }
}
