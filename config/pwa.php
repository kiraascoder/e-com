<?php

return [
    'install-button' => true,
    'manifest' => [
        'name' => 'Lapor Pu Parepare',
        'short_name' => 'LaporPak',
        'background_color' => '#ffffff',
        'theme_color' => '#6777ef',
        'display' => 'standalone',
        'description' => 'Lapor Pekerjaan Umum Parepare',
        'icons' => [
            [
                'src' => 'logo-512x512.png',
                'sizes' => '512x512',
                'type' => 'image/png',
            ],
        ],
    ],
    'debug' => env('APP_DEBUG', false),    
];
