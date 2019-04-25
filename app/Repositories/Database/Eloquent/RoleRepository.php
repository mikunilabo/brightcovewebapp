<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Model\Eloquent\Role;

final class RoleRepository extends EloquentRepository
{
    /**
     * @param Role $eloquent
     */
    public function __construct(Role $eloquent)
    {
        $this->eloquent = $eloquent;
    }
}
