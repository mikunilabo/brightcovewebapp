<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

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
}
