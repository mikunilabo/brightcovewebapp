<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\UtilitiesService;
use Illuminate\Support\ServiceProvider;

final class FacadeServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton('utilities', UtilitiesService::class);
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::provides()
     * @return array
     */
    public function provides(): array
    {
        return [
            'utilities',
        ];
    }
}
