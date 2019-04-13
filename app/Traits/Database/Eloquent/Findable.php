<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait Findable
{
    /**
     * @param mixed $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->repo->find($id);
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function findMany(array $ids = []): Collection
    {
        return $this->repo->findMany($ids);
    }

    /**
     * @param array $args
     * @return Collection
     */
    public function findAll(array $args = []): Collection
    {
        return $this->repo->findAll($args);
    }
}
