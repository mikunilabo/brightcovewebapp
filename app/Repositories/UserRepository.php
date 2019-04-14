<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Contracts\Domain\RepositoryContract;
use App\Model\Eloquent\User;
use App\Traits\Database\Eloquent\Creatable;
use App\Traits\Database\Eloquent\Deletable;
use App\Traits\Database\Eloquent\Findable;
use App\Traits\Database\Eloquent\Updatable;
use Illuminate\Database\Eloquent\Builder;
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
     * @param User $eloquent
     */
    public function __construct(User $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function build(Builder $builder): Builder
    {
        return $builder;
    }
}
