<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent\Observers;

use App\Listeners\Database\Eloquent\Observers\UserObserver;

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
