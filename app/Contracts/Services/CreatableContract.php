<?php
declare(strict_types=1);

namespace App\Contracts\Services;

use App\Contracts\Domain\ModelContract;

interface CreatableContract
{
    /**
     * @param array $args
     * @return ModelContract
     */
    public function create(array $args = []): ModelContract;
}
