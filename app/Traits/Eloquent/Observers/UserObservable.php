<?php
declare(strict_types=1);

namespace App\Traits\Eloquent\Observers;

use App\Listeners\Eloquent\Observers\UserObserver;

trait UserObservable
{
    /**
     * @return void
     */
    public static function bootUserObservable(): void
    {
        self::observe(UserObserver::class);
    }
}
