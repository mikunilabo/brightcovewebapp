<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->group(function () {
    Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
//     Route::get($name = 'settings', )->name($name);

    /**
     * Accounts
     */
    Route::prefix($prefix = 'accounts')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Users\IndexController::class)->name('index');
        Route::get($name = 'create', sprintf('%s@%s', \App\Http\Controllers\Users\CreateController::class, 'view'))->name($name);
        Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Users\CreateController::class, $name));
        Route::get($name = 'profile', sprintf('%s@%s', \App\Http\Controllers\Users\ProfileController::class, 'view'))->name($name);
        Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Users\ProfileController::class, 'update'));

        Route::prefix('{userId}')->group(function () {
            Route::get($name = 'detail', sprintf('%s@%s', \App\Http\Controllers\Users\UpdateController::class, 'view'))->name($name);
            Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Users\UpdateController::class, 'update'));
            Route::post($name = 'delete', \App\Http\Controllers\Users\DeleteController::class)->name($name);
        });
    });

    /**
     * Media
     */
    Route::prefix($prefix = 'media')->name(sprintf('%s.', $prefix))->group(function () {
        Route::get('/', \App\Http\Controllers\Media\IndexController::class)->name('index');
        Route::get($name = 'upload', \App\Http\Controllers\Media\CreateController::class)->name($name);

        Route::prefix('{videoId}')->group(function () {
            Route::get($name = 'detail', sprintf('%s@%s', \App\Http\Controllers\Media\UpdateController::class, 'view'))->name($name);
            Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Media\UpdateController::class, 'update'));
            Route::post($name = 'delete', \App\Http\Controllers\Media\DeleteController::class)->name($name);
        });
    });

    /**
     * Authentication
     */
    Route::get($name = 'login', sprintf('%s@showLoginForm', \App\Http\Controllers\Auth\LoginController::class))->name($name);
    Route::post($name,  sprintf('%s@%s', \App\Http\Controllers\Auth\LoginController::class, $name));
    Route::post($name = 'logout', sprintf('%s@%s', \App\Http\Controllers\Auth\LoginController::class, $name))->name($name);

    /**
     * Registration
     */
//     Route::get($name = 'register', sprintf('%s@showRegistrationForm', \App\Http\Controllers\Auth\RegisterController::class))->name($name);
//     Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Auth\RegisterController::class, $name));

    /**
     * Password Reset
     */
    Route::prefix($prefix = 'password')->name(sprintf('%s.', $prefix))->group(function () {
        Route::post($name = 'email', sprintf('%s@sendResetLinkEmail', \App\Http\Controllers\Auth\Password\ForgotController::class))->name($name);
        Route::get($name = 'reset', sprintf('%s@showLinkRequestForm', \App\Http\Controllers\Auth\Password\ForgotController::class))->name('request');
        Route::get(sprintf('%s/{token}', $name), sprintf('%s@showResetForm', \App\Http\Controllers\Auth\Password\ResetController::class))->name($name);
        Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Auth\Password\ResetController::class, $name));
    });

    /**
     * WebAPI
     */
    Route::prefix($prefix = 'webapi')->name(sprintf('%s.', $prefix))->group(function () {
        Route::prefix($prefix = 'accounts')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'deletes', \App\Http\Controllers\Webapi\Users\DeletesController::class)->name($name);
        });

        Route::prefix($prefix = 'media')->name(sprintf('%s.', $prefix))->group(function () {
            Route::post($name = 'create', \App\Http\Controllers\Webapi\Media\CreateController::class)->name($name);
            Route::post($name = 'deletes', \App\Http\Controllers\Webapi\Media\DeletesController::class)->name($name);

            Route::prefix('{videoId}')->group(function () {
                Route::post($name = 's3_url', \App\Http\Controllers\Webapi\Media\GetS3UrlController::class)->name($name);
                Route::post($name = 'ingest', \App\Http\Controllers\Webapi\Media\DynamicIngestController::class)->name($name);
                Route::get($name = 'ingestjobs', \App\Http\Controllers\Webapi\Media\IngestJobsController::class)->name($name);
            });
        });

        Route::prefix($prefix = 'leagues')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = '/', \App\Http\Controllers\Webapi\Leagues\IndexController::class)->name('index');
            Route::prefix('{leagueId}')->group(function () {
                Route::post($name = 'delete', \App\Http\Controllers\Webapi\Leagues\DeleteController::class)->name($name);
            });
        });

        Route::prefix($prefix = 'universities')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = '/', \App\Http\Controllers\Webapi\Universities\IndexController::class)->name('index');
            Route::prefix('{universityId}')->group(function () {
                Route::post($name = 'delete', \App\Http\Controllers\Webapi\Universities\DeleteController::class)->name($name);
            });
        });

        Route::prefix($prefix = 'sports')->name(sprintf('%s.', $prefix))->group(function () {
            Route::get($name = '/', \App\Http\Controllers\Webapi\Sports\IndexController::class)->name('index');
            Route::prefix('{sportId}')->group(function () {
                Route::post($name = 'delete', \App\Http\Controllers\Webapi\Sports\DeleteController::class)->name($name);
            });
        });
    });
});
