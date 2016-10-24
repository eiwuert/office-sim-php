<?php

return [
    
    'connector' => 'mysql',

    'connections' => [

        'json' => [
            'directory' => 'pgsql',
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => __DIR__.'/../database/office.db',
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'port' => '3306',
            'database' => 'vagrant',
            'username' => 'vagrant',
            'password' => 'welcome',
        ],
    ],

];