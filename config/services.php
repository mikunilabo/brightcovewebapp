<?php
declare(strict_types=1);

use Monolog\Logger;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Model\Eloquent\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'videocloud' => [
        'account_id'    => env('VIDEOCLOUD_ACCOUNT_ID'),
        'client_id'     => env('VIDEOCLOUD_CLIENT_ID'),
        'client_secret' => env('VIDEOCLOUD_CLIENT_SECRET'),
        'video_profile' => env('VIDEOCLOUD_VIDEO_PROFILE'),
    ],

    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY'),
    ],

    'slack' => [
        'webhook_url'               => env('SLACK_WEBHOOK_URL'),
        'channel'                   => null,
        'username'                  => sprintf('%s Bot [%s]', env('APP_NAME', 'Laravel'), env('APP_ENV', 'local')),
        'use_attachment'            => true,
        'icon_emoji'                => null,
        'use_short_attachment'      => true,
        'include_context_and_extra' => true,
        'level'                     => env('SLACK_LOG_LEVEL', Logger::EMERGENCY),
        'bubble'                    => true,
        'exclude_fields'            => [],
    ],

];
