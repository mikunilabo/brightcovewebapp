const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/**
 * Custom settings
 */
mix.webpackConfig({
    resolve: {
        alias: {
            pace: 'pace-progress'
        }
    }
});

/**
 * JS
 */
// The following modules unique to the coreui page are undefined function unless they are described
// in the same file as the tooltip plugin, so build the combined file.
mix.js('resources/js/vendor/coreui/main.js', 'public/js/vendor/coreui');
mix.js('resources/js/vendor/coreui/charts.js', 'public/js/vendor/coreui');
mix.js('resources/js/vendor/coreui/widgets.js', 'public/js/vendor/coreui');

mix.js('resources/js/app.js', 'public/js')
    .extract([
        'jquery',
        'bootstrap',
        'pace-progress',
        'perfect-scrollbar',
        '@coreui/coreui',
        'chart.js',
//        'vue',
    ]);

/**
 * CSS
 */
mix.sass('resources/sass/app.scss', 'public/css');

/**
 * Source Maps
 */
mix.sourceMaps();

/**
 * Versioning
 */
if (mix.inProduction()) {
    mix.version();
}

/**
 * Hot reloading
 */
if (process.env.MIX_APP_URL) {
    mix.browserSync({
        proxy: process.env.MIX_APP_URL,
        watchOptions: {
            usePolling: true,
            interval: 100
        },
        reloadOnRestart: true,
//        open: "external",
//        browser: "google chrome",
//        ui: false
    });
}

/**
 * Browser Notifications
 */
//mix.disableNotifications();
