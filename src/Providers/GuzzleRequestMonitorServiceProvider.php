<?php

namespace IntelligentsNL\GuzzleRequestMonitor\Providers;

use IntelligentsNL\GuzzleRequestMonitor\GuzzleRequestMonitor;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class GuzzleRequestMonitorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/guzzle-request-monitor.php', 'guzzle-request-monitor');

        $this->publishes([
            __DIR__ . '/../../config/guzzle-request-monitor.php' => config_path('guzzle-request-monitor.php'),
        ], 'guzzle-request-monitor-config');
    }
}