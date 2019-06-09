<?php
declare(strict_types=1);

return [

    /*
     |--------------------------------------------------------------------------
     | Application Administrators Credentials
     |--------------------------------------------------------------------------
     |
     */

    'users' => [
        'admin' => [
            'name'     => env('TEST_ADMIN_NAME'),
            'email'    => env('TEST_ADMIN_EMAIL'),
            'password' => env('TEST_ADMIN_PASSWORD', 'password'),
            'role_id'  => 1,
        ],
        'user' => [
            'name'     => env('TEST_USER_NAME'),
            'email'    => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORD', 'password'),
            'role_id'  => 2,
        ],
    ],

];
