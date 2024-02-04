<?php

return [
    'destination' => [
        'class' => \IntelligentsNL\GuzzleRequestMonitor\File::class,
        'path'  => base_path('logs/guzzle-request-monitor.log'),
    ],
    'formatter'   => [
        'class' => \IntelligentsNL\GuzzleRequestMonitor\DefaultFormatter::class
    ],
];
