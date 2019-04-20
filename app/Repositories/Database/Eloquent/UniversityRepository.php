<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Contracts\Domain\RepositoryContract;
use App\Model\Eloquent\University;
use App\Traits\Database\Eloquent\Creatable;
use App\Traits\Database\Eloquent\Deletable;
use App\Traits\Database\Eloquent\Findable;
use App\Traits\Database\Eloquent\Updatable;
use Illuminate\Database\Eloquent\Model;

final class UniversityRepository implements RepositoryContract
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
    public function __construct(University $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param mixed $builder
     * @return mixed
     */
    public function build($builder)
    {
        return $builder;
    }
}
