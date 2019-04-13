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
                'name' => 'Test User',
                'email' => config('app.user'),
                'password' => bcrypt(config('app.password')),
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
                    User::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
