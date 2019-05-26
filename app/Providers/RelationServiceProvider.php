<?php
declare(strict_types=1);

namespace App\Providers;

use App\Model\Eloquent\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

final class RelationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->morphMap();
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
    private function morphMap(): void
    {
        Relation::morphMap([
            'user' => User::class,
        ]);
    }
}
