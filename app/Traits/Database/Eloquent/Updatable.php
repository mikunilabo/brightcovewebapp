<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

trait Updatable
{
    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool
    {
        return $this->repo->update($id, $args);
    }
}
