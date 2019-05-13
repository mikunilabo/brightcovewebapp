<?php
declare(strict_types=1);

namespace App\Model;

use App\Contracts\Domain\ModelContract;

final class Media implements ModelContract
{
    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
