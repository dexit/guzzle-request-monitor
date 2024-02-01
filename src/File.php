<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use Illuminate\Support\Facades\Storage;

class File extends Destination
{

    public function store(array $data): void
    {
        $path = config('guzzle-request-monitor.destination.path');

        if (!Storage::exists($path)) {
            //TODO Test if needed
            Storage::put($path, '');
        }

        Storage::append($path, json_encode($data));
    }
}