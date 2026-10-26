<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        'production' => [
            'adapter' => 'mysql',
            'host' => '89.116.229.207',
            'name' => 'php',
            'user' => 'root',
            'pass' => '0V2uN7cqlbh2zKvhZE0gJqFNoMlHevYWU',
            'port' => '37200',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
