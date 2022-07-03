<?php
return [
    'mongo' => [
        'key' => 'mongo'
    ],
    'redis' => [
        'table' => [
            'single' => 'cache:single:%s',// FROM单表缓存
            'join' => 'cache:join:%s',// JOIN多表缓存
        ]
    ]
];