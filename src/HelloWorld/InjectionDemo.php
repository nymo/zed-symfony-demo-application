<?php

namespace App\HelloWorld;

final class InjectionDemo
{
    public function describe(): string
    {
        return $this->generator->generate();
    }
}
