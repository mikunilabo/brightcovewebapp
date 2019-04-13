<?php
declare(strict_types=1);

namespace App\Contracts\Services;

use App\Contracts\Domain\ModelContract;
use Illuminate\Support\Collection;

interface FindableContract
{
    /**
     * @param mixed $id
     * @return ModelContract|null
     */
    public function find($id): ?ModelContract;

    /**
     * @param array $args
     * @return Collection
     */
    public function findAll(array $args = []): Collection;

}
