<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class UrlServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->forceHttps();
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    private function forceHttps(): void
    {
        /**
         * Force Https connection under certain circumstances and conditions.
         */
        if (true === config('session.secure')) {
            URL::forceScheme('https');
        }
    }
}
