<?php
declare(strict_types=1);

namespace App\Contracts\Domain;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RepositoryContract
{
    /**
     * @param array $args
     * @return ModelContract
     */
    public function create(array $args = []): ModelContract;

    /**
     * @param mixed $id
     * @param array $args
     * @return bool
     */
    public function update($id, array $args = []): bool;

    /**
     * @param mixed $id
     * @return void
     */
    public function delete($id): void;

    /**
     * @param mixed $id
     * @return ModelContract|null
     */
    public function findById($id): ?ModelContract;

    /**
     * @param array $args
     * @param bool $paginate
     * @return Collection|LengthAwarePaginator
     */
    public function findAll(array $args = [], $paginate = false);
}
