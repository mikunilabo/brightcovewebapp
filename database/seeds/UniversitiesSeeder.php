<?php
declare(strict_types=1);

use App\Model\Eloquent\University;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class UniversitiesSeeder extends Seeder
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
                'name' => '東京大学',
            ],
            [
                'name' => '慶應義塾大学',
            ],
            [
                'name' => '早稲田大学',
            ],
            [
                'name' => '明治大学',
            ],
            [
                'name' => '立教大学',
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
                    University::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
