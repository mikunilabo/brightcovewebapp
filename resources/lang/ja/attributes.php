<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Attributes Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'users' => [
        'id'                    => __('ID'),
        'name'                  => __('Name'),
        'email'                 => __('E-Mail'),
        'company'               => __('Company Name'),
        'role_id'               => __('Role'),
        'password'              => __('Password'),
        'password_confirmation' => __('Repeat Password'),
        'leagues.*'             => __('Leagues'),
        'sports.*'              => __('Sports'),
        'universities.*'        => __('Universities'),
    ],

];
