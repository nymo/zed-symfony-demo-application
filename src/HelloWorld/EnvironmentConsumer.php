<?php

namespace App\HelloWorld;

final class EnvironmentConsumer
{
    public function __construct(private readonly string $secret)
    {
    }

    public function configured(): bool
    {
        return $this->secret !== '';
    }
}
