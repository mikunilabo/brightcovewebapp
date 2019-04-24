<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Model\Eloquent\Sport;

final class SportRepository extends EloquentRepository
{
    /**
     * @param Sport $eloquent
     */
    public function __construct(Sport $eloquent)
    {
        $this->eloquent = $eloquent;
    }
}
