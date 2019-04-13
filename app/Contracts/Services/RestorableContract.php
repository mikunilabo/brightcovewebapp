<?php
declare(strict_types=1);

namespace App\Contracts\Services;

interface RestorableContract
{
    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void;
}
