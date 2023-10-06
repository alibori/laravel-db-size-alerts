<?php

declare(strict_types=1);

return [
    /**
     * |--------------------------------------------------------------------------
     * | Alibori\LaravelDbSizeAlerts configuration file
     * |--------------------------------------------------------------------------
     */

    /**
     * Tables to check
     */
    'tables' => [
        'users',
        'posts',
        'comments',
    ],

    /**
     * Default maximum size of a table in MB
     */
    'table_max_mb_size' => 1024,

    'emails_to_notify' => [
        // 'john.doe@example.com',
    ],
];
