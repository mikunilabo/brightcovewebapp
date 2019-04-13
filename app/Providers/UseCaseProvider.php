<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\UsersService;
use App\UseCases\Users\GetUsers;
use Illuminate\Support\ServiceProvider;

final class UseCaseProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

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
        $this->registerUsecases();
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::provides()
     * @return array
     */
    public function provides(): array
    {
        return [
            GetUsers::class,
        ];
    }

    /**
     * @return void
     */
    private function registerUsecases(): void
    {
        /**
         * Users
         */
        $this->app->bind(GetUsers::class, function () {
            return new GetUsers(
                app(UsersService::class)
            );
        });
    }
}
