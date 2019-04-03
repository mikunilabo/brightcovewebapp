<?php
declare(strict_types=1);

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider;

final class LocalServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $providers = [
        CollisionServiceProvider::class,
        DebugbarServiceProvider::class,
//         DumpServerServiceProvider::class,
        IdeHelperServiceProvider::class,
//         Laravel\Dusk\DuskServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $aliases = [
        //
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->registerProviders();
            $this->registerAliases();
        }
    }

    /**
     * @return void
     */
    protected function registerProviders(): void
    {
        if (count($this->providers)) {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * @return void
     */
    protected function registerAliases(): void
    {
        if (count($this->aliases)) {
            $loader = AliasLoader::getInstance();

            foreach ($this->aliases as $alias => $facade) {
                $loader->alias($alias, $facade);
            }
        }
    }

}
