<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

trait Restorable
{
    /**
     * @param mixed $id
     * @return void
     */
    public function restore($id): void
    {
        if (is_null($model = $this->eloquent->find($id))) {
            return;
        }

        $model->restore();
    }
}
