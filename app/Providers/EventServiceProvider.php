<?php
declare(strict_types=1);

namespace App\Providers;

use App\Listeners\Users\LoginListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        Login::class => [
            LoginListener::class,
        ],
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        //
    }
}
