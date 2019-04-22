<?php
declare(strict_types=1);

use App\Model\Eloquent\Sport;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
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
                'name' => '野球',
            ],
            [
                'name' => 'サッカー',
            ],
            [
                'name' => 'ラグビー',
            ],
            [
                'name' => 'テニス',
            ],
            [
                'name' => 'バレーボール',
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
                    Sport::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
