<?php
declare(strict_types=1);

use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\SlackWebhookHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->configureMonologUsing(function(LoggerInterface $monolog) {
    /** @var FormatterInterface $formatter */
    $formatter = tap(new LineFormatter(null, null, true, true), function (FormatterInterface $formatter) {
        $formatter->includeStacktraces();
    });

    /**
     * Daily log
     * @var Logger $monolog
     */
    $monolog->pushHandler(
        tap(new RotatingFileHandler(
            storage_path(sprintf('logs/%s.log', get_current_user())),
            config('app.log_max_files'),
            config('app.log_level'),
            true,
            0664
        ), function (HandlerInterface $handler) use ($formatter) {
            $handler->setFormatter($formatter);
        })
    );

    $config = config('services.slack');

    if ($config['webhook_url']) {
        /**
         * Slack Webhook
         */
        $monolog->pushHandler(
            tap(new SlackWebhookHandler(
                $config['webhook_url'],
                $config['channel'],
                $config['username'],
                $config['use_attachment'],
                $config['icon_emoji'],
                $config['use_short_attachment'],
                $config['include_context_and_extra'],
                $config['level'],
                $config['bubble'],
                $config['exclude_fields']
            ), function (HandlerInterface $handler) use ($formatter) {
                $handler->setFormatter($formatter);
            })
        );
    }
});

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
