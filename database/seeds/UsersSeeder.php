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
        foreach (config('accounts.administrators') as $key => $items) {
            if (empty($items['email']))  continue;

            foreach (config('accounts.environments') as $env => $names) {
                if (app()->environment($env) && in_array($key, $names, true)) {
                    $this->items[] = $items;
                }
            }
        }

        if (! count($this->items)) {
            $this->items[] = config('accounts.dummy');
        }

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
//                 factory(User::class, 100)->create();
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
