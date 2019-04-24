<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Model\Eloquent\League;

final class LeagueRepository extends EloquentRepository
{
    /**
     * @param League $eloquent
     */
    public function __construct(League $eloquent)
    {
        $this->eloquent = $eloquent;
    }
}
