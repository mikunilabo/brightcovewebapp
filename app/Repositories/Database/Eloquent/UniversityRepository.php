<?php
declare(strict_types=1);

namespace App\Repositories\Database\Eloquent;

use App\Model\Eloquent\University;

final class UniversityRepository extends EloquentRepository
{
    /**
     * @param University $eloquent
     */
    public function __construct(University $eloquent)
    {
        $this->eloquent = $eloquent;
    }
}
