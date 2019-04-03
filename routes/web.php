<?php

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

Auth::routes();

Route::prefix('/')->middleware('auth')->group(function () {
    Route::view('/', $name = 'home')->name($name);

    /**
     * Theme
     */
    Route::prefix($prefix = 'theme')->name(sprintf('%s.', $prefix))->group(function () use ($prefix) {
        Route::view($name = 'colors', sprintf('%s.%s', $prefix, $name))->name($name);
        Route::view($name = 'typography', sprintf('%s.%s', $prefix, $name))->name($name);
    });

    /**
     * Components
     */
    Route::prefix($prefix = 'components')->name(sprintf('%s.', $prefix))->group(function () use ($prefix) {
        Route::view($name = 'charts', sprintf('%s.%s', $prefix, $name))->name($name);
        Route::view($name = 'widgets', sprintf('%s.%s', $prefix, $name))->name($name);

        Route::prefix($prefix2 = 'base')->name(sprintf('%s.', $prefix2))->group(function () use ($prefix, $prefix2) {
            Route::view($name = 'breadcrumb', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'cards', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'carousel', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'collapse', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'forms', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'jumbotron', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'list_group', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'navs', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'pagination', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'popovers', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'progress', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'scrollspy', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'switches', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'tables', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'tabs', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'tooltips', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
        });

        Route::prefix($prefix2 = 'buttons')->name(sprintf('%s.', $prefix2))->group(function () use ($prefix, $prefix2) {
            Route::view($name = 'buttons', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'button_group', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'dropdowns', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'brand_buttons', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
        });

        Route::prefix($prefix2 = 'icons')->name(sprintf('%s.', $prefix2))->group(function () use ($prefix, $prefix2) {
            Route::view($name = 'coreui_icons', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'flags', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'font_awesome', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'simple_line_icons', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
        });

        Route::prefix($prefix2 = 'notifications')->name(sprintf('%s.', $prefix2))->group(function () use ($prefix, $prefix2) {
            Route::view($name = 'alerts', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'badges', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
            Route::view($name = 'modals', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);
        });
    });

    /**
     * Extras
     */
    Route::prefix($prefix = 'extras')->name(sprintf('%s.', $prefix))->group(function () use ($prefix) {
        Route::prefix($prefix2 = 'pages')->name(sprintf('%s.', $prefix2))->group(function () use ($prefix, $prefix2) {
            Route::view($name = 'login', sprintf('auth.%s', $name), ['demo' => true])->name($name);
            Route::view($name = 'register', sprintf('auth.%s', $name), ['demo' => true])->name($name);
            Route::view($name = 'blank', sprintf('%s.%s.%s', $prefix, $prefix2, $name))->name($name);

            Route::prefix($prefix3 = 'password')->name(sprintf('%s.', $prefix3))->group(function () {
                Route::view($name = 'request', 'auth.passwords.email', ['demo' => true])->name($name);
                Route::view($name = 'reset', 'auth.passwords.reset', ['demo' => true, 'token' => null])->name($name);
            });

            Route::prefix($prefix3 = 'errors')->name(sprintf('%s.', $prefix3))->group(function () use ($prefix3) {
                Route::view($name = '404', sprintf('%s.%s', $prefix3, $name), ['demo' => true])->name($name);
                Route::view($name = '500', sprintf('%s.%s', $prefix3, $name), ['demo' => true])->name($name);
            });
        });
    });
});
