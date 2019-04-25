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
     * @return mixed
     */
    public function build($builder)
    {
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
