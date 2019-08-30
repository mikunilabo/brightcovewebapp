<?php
declare(strict_types=1);

use App\Model\Eloquent\Role;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    use Transactionable;

    /** @var array */
    private $items = [];

    /**
     * @return void
     */
    public function __construct()
    {
        $this->items = [
            [
                'id'   => 1,
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'id'   => 2,
                'name' => 'User',
                'slug' => 'user',
            ],
        ];
    }

    /**
     * @return void
     */
    public function run()
    {
        try {
            $this->transaction(function () {
                collect($this->items)->each(function ($item) {
                    Role::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
