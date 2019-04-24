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
        foreach (config('accounts.administrators') as $key => $value) {
            if (empty($value['email']))  continue;

            if (app()->isLocal()) {
                if ($key !== 'ktoda' && $key !== 'kwada') {
                    continue;
                }
            } elseif (app()->environment('develop')) {
                if ($key !== 'tkumagai' && $key !== 'ykumagai' && $key !== 'ktoda' && $key !== 'kwada') {
                    continue;
                }
            } elseif (app()->environment('production')) {
                if ($key !== 'tkumagai' && $key !== 'ykumagai') {
                    continue;
                }
            } else {
                break;
            }

            $this->items[] = $value;
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
