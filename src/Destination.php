<?php

namespace IntelligentsNL\GuzzleRequestMonitor;

use Psr\Http\Message\RequestInterface;

abstract class Destination
{
    public abstract function store(array $data): void;
}