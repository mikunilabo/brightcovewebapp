<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\Database\Eloquent\Creatable;
use App\Traits\Database\Eloquent\Deletable;
use App\Traits\Database\Eloquent\Findable;
// use App\Traits\Database\Eloquent\Restorable;
use App\Traits\Database\Eloquent\Updatable;
use App\Contracts\Services\CreatableContract;
use App\Contracts\Services\DeletableContract;
use App\Contracts\Services\FindableContract;
// use App\Contracts\Services\RestorableContract;
use App\Contracts\Services\UpdatableContract;

final class UsersService implements
    CreatableContract,
    DeletableContract,
    FindableContract,
//     RestorableContract,
    UpdatableContract
{
    use Creatable,
        Deletable,
        Findable,
//         Restorable,
        Updatable;

    /** @var UserRepository */
    private $repo;

    /**
     * @param UserRepository $repo
     */
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

}
