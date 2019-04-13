<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

trait Restorable
{
    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        $this->repo->restore($id);
    }
}
