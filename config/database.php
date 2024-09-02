<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'database.gps.network'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'APP_LOG'),
            'username' => env('DB_USERNAME', 'WEBDEVGPS'),
            'password' => env('DB_PASSWORD', '80913000asd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'second_db' => [
            'driver' => 'mysql',
            'url' => env('SECOND_DB_URL'),
            'host' => env('SECOND_DB_HOST', 'database.gps.network'),
            'port' => env('SECOND_DB_PORT', '3306'),
            'database' => env('SECOND_DB_DATABASE', 'APP_LOG'),
            'username' => env('SECOND_DB_USERNAME', 'WEBDEVGPS'),
            'password' => env('SECOND_DB_PASSWORD', '80913000asd'),
            'unix_socket' => env('SECOND_DB_SOCKET', ''),
            'charset' => env('SECOND_DB_CHARSET', 'utf8mb4'),
            'collation' => env('SECOND_DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'third_db' => [
            'driver' => 'mysql',
            'url' => env('THIRD_DB_URL'),
            'host' => env('THIRD_DB_HOST', 'database.gps.network'),
            'port' => env('THIRD_DB_PORT', '3306'),
            'database' => env('THIRD_DB_DATABASE', 'APP_NGP_OPR'),
            'username' => env('THIRD_DB_USERNAME', 'WEBDEVGPS'),
            'password' => env('THIRD_DB_PASSWORD', '80913000asd'),
            'unix_socket' => env('THIRD_DB_SOCKET', ''),
            'charset' => env('THIRD_DB_CHARSET', 'utf8mb4'),
            'collation' => env('THIRD_DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'db_firebird' => [
            'driver'   => 'firebird',
            'host'     => env('FIREBIRD_DB_HOST', '172.16.1.17'),
            'port'     => env('FIREBIRD_DB_PORT', '3050'),
            'database' => env('FIREBIRD_DB_DATABASE', 'INFO'),
            'username' => env('FIREBIRD_DB_USERNAME', 'SYSDBA'),
            'password' => env('FIREBIRD_DB_PASSWORD', 'masterkey'),
            'charset'  => env('FIREBIRD_DB_CHARSET', 'UTF8'),
            'role'     => null,
            'options' => extension_loaded('pdo_firebird') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'db_localhost' => [
            'driver' => 'mysql',
            'url' => env('DB_LOCALHOST_URL'),
            'host' => env('DB_LOCALHOST_HOST', '127.0.0.1'),
            'port' => env('DB_LOCALHOST_PORT', '3306'),
            'database' => env('DB_LOCALHOST_DATABASE', 'db_log'),
            'username' => env('DB_LOCALHOST_USERNAME', 'root'),
            'password' => env('DB_LOCALHOST_PASSWORD', ''),
            'unix_socket' => env('DB_LOCALHOST_SOCKET', ''),
            'charset' => env('DB_LOCALHOST_CHARSET', 'utf8mb4'),
            'collation' => env('DB_LOCALHOST_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'db_localhost1' => [
            'driver' => 'mysql',
            'url' => env('DB_LOCALHOST_URL'),
            'host' => env('DB_LOCALHOST_HOST', '127.0.0.1'),
            'port' => env('DB_LOCALHOST_PORT', '3306'),
            'database' => env('DB_LOCALHOST_DATABASE', 'db_pindah'),
            'username' => env('DB_LOCALHOST_USERNAME', 'root'),
            'password' => env('DB_LOCALHOST_PASSWORD', ''),
            'unix_socket' => env('DB_LOCALHOST_SOCKET', ''),
            'charset' => env('DB_LOCALHOST_CHARSET', 'utf8mb4'),
            'collation' => env('DB_LOCALHOST_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
