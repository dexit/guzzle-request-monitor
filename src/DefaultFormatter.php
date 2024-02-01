<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use Psr\Http\Message\RequestInterface;

class DefaultFormatter extends Formatter
{

    public function format(RequestInterface $request, array $options): array
    {
        return [
            'host' => $request->getUri()->getHost(),
            'path' => $request->getUri()->getPath(),
        ];
    }
}