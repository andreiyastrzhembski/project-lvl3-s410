<?php
if (getenv('DATABASE_URL')) {
    $connection = 'pgsql';
} else {
    $connection = 'sqlite';
}
return [

    'default' => $connection,

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => 'ec2-174-129-236-21.compute-1.amazonaws.com',
            'port' => '5432',
            'database' => 'd3qlcvu9l09mkj',
            'username' => 'elbqkuxrduiiva',
            'password' => 'a6c2564d11d72c6107f2d3f9596fa5ab98c9f4d06616973dec071da8e12b5386',
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

    ],

    'migrations' => 'migrations',

];
