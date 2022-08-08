<?php

return [
    'name' => env('APP_NAME'),
    'manifest' => [
        'name' => env('APP_NAME'),
        'short_name' => env('APP_NAME'),
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => env('PREFIX').'sistema/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => env('PREFIX').'sistema/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => env('PREFIX').'sistema/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => env('PREFIX').'sistema/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => env('PREFIX').'sistema/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => env('PREFIX').'sistema/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => env('PREFIX').'sistema/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => env('PREFIX').'sistema/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => env('PREFIX').'sistema/icons/splash-640x1136.png',
            '750x1334' => env('PREFIX').'sistema/icons/splash-750x1334.png',
            '828x1792' => env('PREFIX').'sistema/icons/splash-828x1792.png',
            '1125x2436' => env('PREFIX').'sistema/icons/splash-1125x2436.png',
            '1242x2208' => env('PREFIX').'sistema/icons/splash-1242x2208.png',
            '1242x2688' => env('PREFIX').'sistema/icons/splash-1242x2688.png',
            '1536x2048' => env('PREFIX').'sistema/icons/splash-1536x2048.png',
            '1668x2224' => env('PREFIX').'sistema/icons/splash-1668x2224.png',
            '1668x2388' => env('PREFIX').'sistema/icons/splash-1668x2388.png',
            '2048x2732' => env('PREFIX').'sistema/icons/splash-2048x2732.png',
        ],
        'custom' => [
            'tag_name' => 'tag_value',
            'tag_name2' => 'tag_value2',
        ]
    ]
];
