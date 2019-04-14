<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

trait Updatable
{
    /**
     * @param mixed $id
     * @param array $args
     * @return bool
     */
    public function update($id, array $args = []): bool
    {
        if (is_null($model = $this->eloquent->find($id))) {
            return false;
        }

        return $model->update($args);
    }
}
