<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use Illuminate\Support\Facades\Storage;

class File extends Destination
{

    public function store(array $data): void
    {
        Storage::append(config('guzzle-request-monitor.destination.path'), json_encode($data));
    }
}