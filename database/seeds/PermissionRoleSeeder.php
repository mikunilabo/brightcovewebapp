<?php
declare(strict_types=1);

use App\Model\Eloquent\Permission;
use App\Model\Eloquent\Role;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
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
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                foreach (Role::all() as $role) {
                    foreach (Permission::all() as $permission) {
                        if ($role->slug === 'admin') {
                            if (starts_with($permission->slug, 'user-')) {
                                $role->permissions()->toggle([$permission->id]);
                            }
                        } elseif ($role->slug === 'user') {
                            if (starts_with($permission->slug, 'media-')) {
                                $role->permissions()->toggle([$permission->id]);
                            }
                        }
                    }
                }
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
