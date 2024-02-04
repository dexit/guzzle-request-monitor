<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\RejectedPromise;
use IntelligentsNL\GuzzleRequestMonitor\Exceptions\GuzzleRequestMonitorException;
use Psr\Http\Message\RequestInterface;

class GuzzleRequestMonitor
{
    
    public static function handler(?string $queue = null): callable
    {
        return function (callable $handler) use ($queue): callable {
            return function (RequestInterface $request, array $options) use ($handler, $queue): RejectedPromise {
                $formatter = app(config('guzzle-request-monitor.formatter.class'));
                
                if (!($formatter instanceof Formatter)) {
                    throw new GuzzleRequestMonitorException('Formatter incorrectly defined in config.');
                }

                $destination = app(config('guzzle-request-monitor.destination.class'));

                if (!($destination instanceof Destination)) {
                    throw new GuzzleRequestMonitorException('Destination incorrectly defined in config.');
                }

                $destination->store($formatter->format($request, $options));

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