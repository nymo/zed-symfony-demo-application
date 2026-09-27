<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('demo.php.consumer', App\HelloWorld\ServiceConsumer::class)
        ->arg('$generator', service('hello.world.generator'))
        ->tag('app.greeting_consumer');

    $services->alias('demo.php.generator_alias', 'hello.world.generator');

    $services->set('demo.php.environment_consumer', App\HelloWorld\EnvironmentConsumer::class)
        ->arg('$secret', env('APP_SECRET'));
};
