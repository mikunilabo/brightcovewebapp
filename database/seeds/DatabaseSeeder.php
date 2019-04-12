<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
