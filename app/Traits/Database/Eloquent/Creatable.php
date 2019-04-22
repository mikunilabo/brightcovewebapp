<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

use App\Contracts\Domain\ModelContract;

trait Creatable
{
    /**
     * @param array $args
     * @return ModelContract
     */
    public function create(array $args = []): ModelContract
    {
        return $this->eloquent->create($args);
    }
}
