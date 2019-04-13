<?php
declare(strict_types=1);

namespace App\Contracts\Services;

interface UpdatableContract
{
    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool;
}
