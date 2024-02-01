<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use Illuminate\Support\Facades\Storage;

class CloudWatch extends Destination
{
    public function store(array $data): void
    {
        Log::channel('cloudwatch')->info(json_encode($data));
    }
}