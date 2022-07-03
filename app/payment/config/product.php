<?php
declare(strict_types=1);

return [
    'http' => [
        'server' => 'http://www.payment.com',
        'uri' => '/',
    ],
    'application' => [
        'prefix' => 'hp_',
        'modules' => 'index,api',
        'directory' => '/usr/local/openresty/nginx/html/HookPHP/app/payment',
        'dispatcher' => [
            'catchException' => '1',
            'defaultAction' => 'get',
        ]
    ],
    'mysql' => [
        'default' => [
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'hookphp',
            'charset' => 'utf8mb4',
            'username' => 'root',
            'passwd' => '123456',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        ]
    ],
    'redis' => [
        'default' => [
            'host' => '127.0.0.1',
            'port' => '6379',
            'timeout' => '1',
            'reserved' => '',
            'interval' => '100',
            'auth' => '123456',
        ]
    ],
    'mongo' => [
        'default' => [
            'uri' => 'mongodb://root:root@localhost:27017,127.0.0.1:27017/admin?readPreference=secondary',
            'uriOptions' => '',
            'driverOptions' => '',
        ]

    ],
    'openssl' => [
        'iv' => '1234567812345678',
        'method' => 'AES-256-CBC',
        'password' => '`BUhe67(*&{",;?`',
    ],
];