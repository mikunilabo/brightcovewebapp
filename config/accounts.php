<?php
declare(strict_types=1);

return [

    /*
     |--------------------------------------------------------------------------
     | Application Administrators Credentials
     |--------------------------------------------------------------------------
     |
     */

    'administrators' => [
        'tkumagai' => [
            'name'     => env('ADMIN_TKUMAGAI_NAME'),
            'email'    => env('ADMIN_TKUMAGAI_EMAIL'),
            'password' => env('ADMIN_TKUMAGAI_PASSWORD', 'password'),
            'role_id'  => 1,
        ],
        'ykumagai' => [
            'name'     => env('ADMIN_YKUMAGAI_NAME'),
            'email'    => env('ADMIN_YKUMAGAI_EMAIL'),
            'password' => env('ADMIN_YKUMAGAI_PASSWORD', 'password'),
            'role_id'  => 1,
        ],
        'ktoda' => [
            'name'     => env('ADMIN_KTODA_NAME'),
            'email'    => env('ADMIN_KTODA_EMAIL'),
            'password' => env('ADMIN_KTODA_password', 'password'),
            'role_id'  => 1,
        ],
        'kwada' => [
            'name'     => env('ADMIN_KWADA_NAME'),
            'email'    => env('ADMIN_KWADA_EMAIL'),
            'password' => env('ADMIN_KWADA_PASSWORD', 'password'),
            'role_id'  => 1,
        ],
    ],

    'environments' => [
        'production' => [
            'tkumagai',
            'ykumagai',
        ],
        'develop' => [
            'tkumagai',
            'ykumagai',
            'ktoda',
            'kwada',
        ],
        'local' => [
            'ktoda',
            'kwada',
        ],
    ],

    'dummy' => [
        'name'     => 'Mr.Dummy',
        'email'    => 'dummy@example.com',
        'password' => 'password',
        'role_id'  => 1,
    ],

];
