<?php

namespace App\HelloWorld;

final class ServiceConsumer
{
    public function __construct(private readonly Generator $generator)
    {
    }

    public function generate(): string
    {
        return $this->generator->generate();
    }
}
