<?php
declare(strict_types=1);

use App\Model\Eloquent\User;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                'name' => 'Test user',
                'email' => config('app.user'),
                'company' => 'Test, Inc.',
                'password' => config('app.password'),
                'role_id' => 1,
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
                    User::forceCreate($item);
                });

                factory(User::class, 100)->create();
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
