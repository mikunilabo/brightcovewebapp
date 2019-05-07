<?php
declare(strict_types=1);

namespace App\Model;

use App\Contracts\Domain\ModelContract;

final class Media implements ModelContract
{
    /** @var array */
    private $attributes = [];

    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : null;
    }

    /**
     * @param string $name
     * @param void
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
