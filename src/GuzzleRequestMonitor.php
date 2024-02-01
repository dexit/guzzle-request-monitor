<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\RejectedPromise;
use Illuminate\Foundation\Bus\DispatchesJobs;
use IntelligentsNL\GuzzleRequestMonitor\Exceptions\GuzzleRequestMonitorException;
use IntelligentsNL\GuzzleRequestMonitor\Jobs\GuzzleRequestMonitorJob;
use Psr\Http\Message\RequestInterface;

class GuzzleRequestMonitor
{
    
    use DispatchesJobs;

    public static function handler(?string $queue = null): callable
    {
        return function (callable $handler) use ($queue): callable {
            return function (RequestInterface $request, array $options) use ($handler, $queue): RejectedPromise {
                $formatter= app(config('guzzle-request-monitor.formatter.class'));
                
                if (!($formatter instanceof Formatter)) {
                    throw new GuzzleRequestMonitorException('Formatter incorrectly defined in config.');
                }

                $queue ??= config('guzzle-request-monitor.queue');
                
                $job = new GuzzleRequestMonitorJob($formatter->format($request, $options));

                if (!isset($queue) || $queue === 'sync') {
                    dispatch_sync($job);
                } else {
                    dispatch($job)->onQueue($queue);
                }

                return $handler($request, $options);
            };
        };
    }

    public static function getClient(array $options = []): Client
    {
        $options['handler'] ??= HandlerStack::create();

        $options['handler']->push(GuzzleRequestMonitor::handler());

        return new Client($options);
    }
}