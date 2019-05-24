<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Contracts\Domain\RepositoryContract;
use App\Traits\Database\Eloquent\Creatable;
use App\Traits\Database\Eloquent\Deletable;
use App\Traits\Database\Eloquent\Findable;
use App\Traits\Database\Eloquent\Updatable;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements RepositoryContract
{
    use Creatable,
        Deletable,
        Findable,
        Updatable;

    /** @var Model */
    protected $eloquent;

    /**
     * @param mixed $builder
     * @param array $args
     * @return mixed
     */
    public function build($builder, $args = [])
    {
        if (array_key_exists($key = 'select', $args)) {
            $builder->addSelect($args[$key]);
        }

        if (array_key_exists($key = 'with', $args)) {
            $builder->with($args[$key]);
        }

        if (array_key_exists($key = 'orders', $args)) {
            if (array_key_exists($key2 = 'latest', $args[$key])) {
                $builder->latest($args[$key][$key2]);
            }
        }

        return $builder;
    }

    /**
     * @return Model
     */
    public function entity(): Model
    {
        return $this->eloquent;
    }
}
