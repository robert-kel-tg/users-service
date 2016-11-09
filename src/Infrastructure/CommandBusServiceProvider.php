<?php

namespace Robertke\User\Infrastructure;

use Bezdomni\Tactician\Pimple\PimpleLocator;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CommandBusServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['c.command_bus'] = function (Container $c) {
            $middleware = [
                new CommandHandlerMiddleware(
                    new ClassNameExtractor(),
                    new PimpleLocator($c, $c['commands.handlers']),
                    new HandleInflector()
                )
            ];
            return new CommandBus($middleware);
        };
    }
}