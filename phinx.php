<?php
(new Dotenv\Dotenv(__DIR__))->load();

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
            //'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' =>
            [
                'default_database' => 'development',
                'default_migration_table' => 'phinxlog',
                'development'      =>
                    [
                        'adapter' => 'mysql',
                        'host' => $_ENV['DB_HOST'],
                        'name' => $_ENV['DB_DATABASE'],
                        'user' => $_ENV['DB_USR'],
                        'pass' => $_ENV['DB_PWD'],
                        'port' => 3306,
                        'charset' => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                    ],
            ],
    ];