<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * @return void
     */
    public function boot(): void
    {
        //

        parent::boot();
    }

    /**
     * @return void
     */
    public function map(): void
    {
//         $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
//              ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
