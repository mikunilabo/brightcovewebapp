<?php
declare(strict_types=1);

use App\Model\Eloquent\Permission;
use App\Traits\Database\Transactionable;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
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
                'name' => 'アカウント閲覧',
                'slug' => 'user-select',
            ],
            [
                'id'   => 2,
                'name' => 'アカウント作成',
                'slug' => 'user-create',
            ],
            [
                'id'   => 3,
                'name' => 'アカウント更新',
                'slug' => 'user-update',
            ],
            [
                'id'   => 4,
                'name' => 'アカウント削除',
                'slug' => 'user-delete',
            ],
            [
                'id'   => 5,
                'name' => 'メディア閲覧',
                'slug' => 'media-select',
            ],
            [
                'id'   => 6,
                'name' => 'メディア作成',
                'slug' => 'media-create',
            ],
            [
                'id'   => 7,
                'name' => 'メディア更新',
                'slug' => 'media-update',
            ],
            [
                'id'   => 8,
                'name' => 'メディア削除',
                'slug' => 'media-delete',
            ],
            [
                'id'   => 9,
                'name' => 'メディアアップロード',
                'slug' => 'media-upload',
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
                    Permission::create($item);
                });
            });
        } catch (\Exception $e) {
            report($e);
            dd($e->getMessage());
        }
    }
}
