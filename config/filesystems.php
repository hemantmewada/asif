<?php

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'throw' => false,
        ],

        'private' => [
            'driver' => 'local',
            'root' => storage_path('app/private-documents'),
            'throw' => true,
        ],

        'previews' => [
            'driver' => 'local',
            'root' => storage_path('app/previews'),
            'throw' => true,
        ],
    ],
];
