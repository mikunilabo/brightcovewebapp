<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

use Illuminate\Support\Collection;

trait Deletable
{
    /**
     * @param mixed $id
     * @return void
     */
    public function delete($id): void
    {
        if (is_null($model = $this->eloquent->find($id))) {
            return;
        }

        $model->delete();
    }

    /**
     * @param Collection $items
     * @return void
     */
    public function deletes(Collection $items): void
    {
        $items->map(function ($item) {
            $item->delete();
        });
    }
}
