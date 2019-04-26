<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Views\Composers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->viewComposers();
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
    private function viewComposers(): void
    {
        View::composer([
            'media.upload',
            'users.create',
            'users.profile',
            'users.detail',
        ], Composers\LeaguesComposer::class);

        View::composer([
            'users.create',
            'users.profile',
            'users.detail',
        ], Composers\RolesComposer::class);

        View::composer([
            'media.upload',
            'users.create',
            'users.profile',
            'users.detail',
        ], Composers\SportsComposer::class);

        View::composer([
            'media.upload',
            'users.create',
            'users.profile',
            'users.detail',
        ], Composers\UniversitiesComposer::class);
    }
}
