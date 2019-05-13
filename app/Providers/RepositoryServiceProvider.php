<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Views\Composers;
use App\Repositories\Database\Eloquent;
use App\Repositories\Vendor\VideoCloud\MediaRepository;
use App\UseCases\Leagues;
use App\UseCases\Media;
use App\UseCases\Universities;
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
            /**
             * Usecases
             */
            Leagues\DeleteLeague::class,
            Leagues\GetLeagues::class,

            Universities\DeleteUniversity::class,
            Universities\GetUniversities::class,

            Media\CreateMedia::class,
            Media\DeleteMedia::class,
            Media\DeletesMedia::class,
            Media\GetIngestJobs::class,
            Media\GetMedia::class,
            Media\GetS3Url::class,
            Media\ingestMedia::class,
            Media\UpdateMedia::class,

            Users\CreateUser::class,
            Users\DeleteUser::class,
            Users\GetUsers::class,
            Users\UpdateUser::class,

            /**
             * ViewComposers
             */
            Composers\LeaguesComposer::class,
            Composers\RolesComposer::class,
            Composers\SportsComposer::class,
            Composers\UniversitiesComposer::class,
        ];
    }

    /**
     * @return void
     */
    private function registerUsecases(): void
    {
        /**
         * Usecases
         */
        $this->app->bind(Leagues\DeleteLeague::class, function () {
            return new Leagues\DeleteLeague(
                app(Eloquent\LeagueRepository::class)
            );
        });

        $this->app->bind(Leagues\GetLeagues::class, function () {
            return new Leagues\GetLeagues(
                app(Eloquent\LeagueRepository::class)
            );
        });

        $this->app->bind(Universities\DeleteUniversity::class, function () {
            return new Universities\DeleteUniversity(
                app(Eloquent\UniversityRepository::class)
            );
        });

        $this->app->bind(Universities\GetUniversities::class, function () {
            return new Universities\GetUniversities(
                app(Eloquent\UniversityRepository::class)
            );
        });

        $this->app->bind(Media\CreateMedia::class, function () {
            return new Media\CreateMedia(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\DeleteMedia::class, function () {
            return new Media\DeleteMedia(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\DeletesMedia::class, function () {
            return new Media\DeletesMedia(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\GetIngestJobs::class, function () {
            return new Media\GetIngestJobs(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\GetMedia::class, function () {
            return new Media\GetMedia(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\GetS3Url::class, function () {
            return new Media\GetS3Url(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\ingestMedia::class, function () {
            return new Media\ingestMedia(
                app(MediaRepository::class)
            );
        });

        $this->app->bind(Media\UpdateMedia::class, function () {
            return new Media\UpdateMedia(
                app(MediaRepository::class)
            );
        });


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

        /**
         * ViewComposers
         */
        $this->app->bind(Composers\LeaguesComposer::class, function () {
            return new Composers\LeaguesComposer(
                app(Eloquent\LeagueRepository::class)
            );
        });

        $this->app->bind(Composers\RolesComposer::class, function () {
            return new Composers\RolesComposer(
                app(Eloquent\RoleRepository::class)
            );
        });

        $this->app->bind(Composers\SportsComposer::class, function () {
            return new Composers\SportsComposer(
                app(Eloquent\SportRepository::class)
            );
        });

        $this->app->bind(Composers\UniversitiesComposer::class, function () {
            return new Composers\UniversitiesComposer(
                app(Eloquent\UniversityRepository::class)
            );
        });
    }
}
