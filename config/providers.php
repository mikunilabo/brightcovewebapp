<?php
declare(strict_types=1);

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider;

return [

    /*
     |--------------------------------------------------------------------------
     | Service providers configuration
     |--------------------------------------------------------------------------
     |
     */

    'collision' => [
        'enable' => env('COLLISION_ENABLE', false),
        'provider' => CollisionServiceProvider::class,
    ],

    'debugbar' => [
        'enable' => env('DEBUGBAR_ENABLE', false),
        'provider' => DebugbarServiceProvider::class,
    ],

    'idehelper' => [
        'enable' => env('IDEHELPER_ENABLE', false),
        'provider' => IdeHelperServiceProvider::class,
    ],
];
