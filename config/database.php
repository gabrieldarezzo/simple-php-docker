<?php

return [
    'default' => env('DB_CONNECTION', 'mysql'),
    'timezone'  => env('DB_TIMEZONE', '+00:00'),
    'migrations' => 'migrations',
    'connections' => [
        'mysql' => [
            'driver'    => 'mysql',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'database'  => env('DB_DATABASE'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'timezone'  => env('DB_TIMEZONE', '+00:00'),
            'prefix'    => '',
            'strict'    => false,
            'sticky' => true
        ],
    ],
];
