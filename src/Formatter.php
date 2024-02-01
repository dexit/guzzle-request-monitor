<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use Psr\Http\Message\RequestInterface;

abstract class Formatter
{
    public abstract function format(RequestInterface $request, array $options): array;
}