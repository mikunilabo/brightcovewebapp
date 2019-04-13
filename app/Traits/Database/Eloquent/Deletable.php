<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

trait Deletable
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->repo->delete($id);
    }

}
