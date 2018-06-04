<?php
return [
    'application' => [
        'name' => 'PHP7',
        'modules' => 'index',
        'directory' => APP_PATH,
        'library' => [
            'directory' => APP_ROOT . '/vendor'
        ],
        'dispatcher' => [
            'catchException' => 1
        ]
    ],
    'mysql' => [
        'master' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'dbname' => 'test',
            'charset' => 'utf8',
            'username' => 'root',
            'passwd' => '123456',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci'
            ]
        ],
        'slave0' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'dbname' => 'mysql',
            'charset' => 'utf8',
            'username' => 'root',
            'passwd' => '123456',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        'slave1' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'dbname' => 'phpmyadmin',
            'charset' => 'utf8',
            'username' => 'root',
            'passwd' => '123456',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        'slave2' => [
            'host' => '127.0.0.1',
            'port' => 3306,
            'dbname' => 'performance_schema',
            'charset' => 'utf8',
            'username' => 'root',
            'passwd' => '123456',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ]
    ],
    'redis' => [
        'master' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 1,
            'reserved' => NULL,
            'interval' => 100,
            'auth' => 123456
        ],
        'slave0' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 1,
            'reserved' => NULL,
            'interval' => 100,
            'auth' => 123456
        ]
    ],
    'HTTP_SERVER' => 'http://www.svn.com',
    'HTTP_URI' => '/'
];