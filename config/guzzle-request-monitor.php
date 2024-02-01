<?php

return [
    'destination' => [
        'class' => \IntelligentsNL\GuzzleRequestMonitor\File::class,
        'path'  => base_path('storage/logs/guzzle-request-monitor.log'),
    ],
    'formatter'   => [
        'class' => \IntelligentsNL\GuzzleRequestMonitor\DefaultFormatter::class
    ],

    'queue' => env('GUZZLE_REQUEST_MONITOR_QUEUE'),
];
