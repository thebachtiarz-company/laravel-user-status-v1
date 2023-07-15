<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default status user code
    |--------------------------------------------------------------------------
    |
    | Define default status user code.
    |
    */
    'default_status_code' => '',

    /*
    |--------------------------------------------------------------------------
    | Status abilities pool
    |--------------------------------------------------------------------------
    |
    | Define available status abilities.
    |
    */
    'status_ability_pool' => [
        'status-user' => ['create', 'update', 'delete'],
        'user-status' => ['create', 'update'],
        'auth-user' => ['create'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Bypass
    |--------------------------------------------------------------------------
    |
    | Define bypass password for ignore gate policies.
    | Make sure the password is very secure.
    |
    */
    'bypass_password' => '',
];
