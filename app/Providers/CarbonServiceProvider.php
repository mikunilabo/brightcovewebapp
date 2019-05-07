<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->macro();
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
    private function macro(): void
    {
        /**
         * @param Carbon|null $carbon
         * @return string
         */
        Carbon::macro('fuzzy', function (Carbon $carbon = null): string {
            $carbon = is_null($carbon) ? new Carbon : $carbon;

            /** @var int $diff */
            $diff = $this->diffInSeconds($carbon);

            switch (true) {
                case $diff < 60:
                    $division = null;// seconds
                    break;
                case $diff < 3600:
                    $division = 60;// minutes
                    break;
                case $diff < 86400:
                    $division = 3600;// hours
                    break;
                case $diff < 2628000:
                    $division = 86400;// days
                    break;
                case $diff < 31536000:
                    $division = 2628000;// months
                    break;
                default:
                    $division = 31536000;// years
            }

            return trans_choice('chooseable.fuzzy_time', $diff, [
                'value' => is_null($division) ? $diff : floor($diff / $division),
            ]);
        });
    }
}
