<?php

namespace App\HelloWorld;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class AutowireConsumer
{
    public function __construct(
        #[Autowire(service: 'hello.world.generator')]
        private readonly Generator $generator,
    ) {
    }

    public function generate(): string
    {
        return $this->generator->generate();
    }
}
