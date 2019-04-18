<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Database\Eloquent;
use App\UseCases\Users;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
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
            Users\CreateUser::class,
            Users\DeleteUser::class,
            Users\GetUsers::class,
            Users\UpdateUser::class
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
        $this->app->bind(Users\CreateUser::class, function () {
            return new Users\CreateUser(
                app(Eloquent\UserRepository::class)
                );
        });

        $this->app->bind(Users\DeleteUser::class, function () {
            return new Users\DeleteUser(
                app(Eloquent\UserRepository::class)
            );
        });

        $this->app->bind(Users\GetUsers::class, function () {
            return new Users\GetUsers(
                app(Eloquent\UserRepository::class)
            );
        });

        $this->app->bind(Users\UpdateUser::class, function () {
            return new Users\UpdateUser(
                app(Eloquent\UserRepository::class)
            );
        });
    }
}
