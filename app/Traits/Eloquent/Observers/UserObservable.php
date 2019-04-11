<?php
declare(strict_types=1);

namespace App\Traits\Eloquent\Observers;

use App\Listeners\Eloquent\UserObserver;

trait UserObservable
{
    public static function bootUserObservable()
    {
        self::observe(UserObserver::class);
    }
}
