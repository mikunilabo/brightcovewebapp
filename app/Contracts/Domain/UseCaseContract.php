<?php
declare(strict_types=1);

namespace App\Contracts\Domain;

interface UseCaseContract
{
    /**
     * @param mixed $args
     * @return mixed
     */
    public function excute(...$args);
}
