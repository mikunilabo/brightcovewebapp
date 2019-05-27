<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
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
        $this->registerProviders();
    }

    /**
     * @return void
     */
    private function registerProviders(): void
    {
        foreach (config('providers') as $provider => $options) {
            if (! $options['enable']) continue;

            $this->app->register($options['provider']);
        }
    }
}
