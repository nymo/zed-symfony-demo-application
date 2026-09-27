<?php

namespace App\HelloWorld;

final class Generator
{
    public function __construct(private readonly string $applicationName)
    {
    }

    public function generate(): string
    {
        return $this->applicationName;
    }
}
