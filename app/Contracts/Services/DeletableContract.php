<?php
declare(strict_types=1);

namespace App\Contracts\Services;

interface DeletableContract
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
