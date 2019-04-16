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
//         Route::get($name = 'create', )->name($name);
//         Route::post($name, );
//         Route::get($name = 'profile', )->name($name);
//         Route::post($name, );

        Route::prefix('{userId}')->group(function () {
            Route::get($name = 'detail', sprintf('%s@%s', \App\Http\Controllers\Users\UpdateController::class, 'view'))->name($name);
            Route::post($name, sprintf('%s@%s', \App\Http\Controllers\Users\UpdateController::class, 'update'));
//             Route::post($name = 'delete', )->name($name);
        });
    });

    /**
     * Media
     */
        Route::prefix($prefix = 'media')->name(sprintf('%s.', $prefix))->group(function () {
//         Route::get('/', )->name('index');
//         Route::get($name = 'upload', )->name($name);
//         Route::post($name, );

        Route::prefix('{videoId}')->group(function () {
//             Route::get($name = 'update', )->name($name);
//             Route::post($name, );
//             Route::post($name = 'delete', )->name($name);
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
});
