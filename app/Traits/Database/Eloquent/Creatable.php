<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

use Illuminate\Database\Eloquent\Model;

trait Creatable
{
    /**
     * @param array $args
     * @return Model
     */
    public function create(array $args = []): Model
    {
        return $this->repo->create($args);
    }

}
