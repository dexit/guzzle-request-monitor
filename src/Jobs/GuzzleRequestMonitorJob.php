<?php

namespace IntelligentsNL\GuzzleRequestMonitor\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use IntelligentsNL\GuzzleRequestMonitor\Destination;
use IntelligentsNL\GuzzleRequestMonitor\Exceptions\GuzzleRequestMonitorException;

class GuzzleRequestMonitorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly array $data
    ) {}

    /**
     * Execute the job.
     * @throws GuzzleRequestMonitorException
     */
    public function handle(): void
    {
        $destination = app(config('guzzle-request-monitor.destination.class'));

        if (!($destination instanceof Destination)) {
            throw new GuzzleRequestMonitorException('Destination incorrectly defined in config.');
        }

        $destination->store($this->data);
    }
}
