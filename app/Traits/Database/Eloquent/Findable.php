<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

use App\Contracts\Domain\ModelContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait Findable
{
    /**
     * @param mixed $id
     * @return ModelContract|null
     */
    public function findById($id): ?ModelContract
    {
        return $this->eloquent->find($id);
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function findByIds(array $ids = []): Collection
    {
        return $this->eloquent->findMany($ids);
    }

    /**
     * @param array $args
     * @param bool $paginate
     * @return Collection|LengthAwarePaginator
     */
    public function findAll(array $args = [], $paginate = false)
    {
        $builder = $this->eloquent->query();

        if (method_exists($this, 'build')) {
            $builder = $this->build($builder);
        }

        return $builder->{$paginate ? 'paginate' : 'get'}();
    }
}
