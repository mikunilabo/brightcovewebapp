<?php
declare(strict_types=1);

use App\Model\Eloquent\League;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class LeaguesSeeder extends Seeder
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
                'name' => '全日本大学野球連盟',
            ],
            [
                'name' => '東京六大学野球連盟',
            ],
            [
                'name' => '全日本大学バスケットボール連盟',
            ],
            [
                'name' => '全日本大学ソフトボール連盟',
            ],
            [
                'name' => '全日本学生レスリング連盟',
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
                    League::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
