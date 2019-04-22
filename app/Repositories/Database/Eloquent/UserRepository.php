<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Contracts\Domain\RepositoryContract;
use App\Model\Eloquent\User;
use App\Traits\Database\Eloquent\Creatable;
use App\Traits\Database\Eloquent\Deletable;
use App\Traits\Database\Eloquent\Findable;
use App\Traits\Database\Eloquent\Updatable;
use Illuminate\Database\Eloquent\Model;

final class UserRepository implements RepositoryContract
{
    use Creatable,
        Deletable,
        Findable,
        Updatable;

    /** @var Model */
    private $eloquent;

    /**
     * @param Model $eloquent
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
