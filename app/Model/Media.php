<?php
declare(strict_types=1);

namespace App\Model;

use App\Contracts\Domain\ModelContract;

final class Media implements ModelContract
{
    /** @var array */
    private static $attributes = [];

    /**
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        self::$attributes = $attributes;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function __get($name)
    {
        return array_key_exists($name, self::$attributes) ? self::$attributes[$name] : null;
    }

    /**
     * @param string $name
     * @param void
     */
    public static function __set($name, $value)
    {
        self::$attributes[$name] = $value;
    }
}
