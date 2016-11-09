<?php

namespace Robertke\User\Infrastructure;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Robertke\User\Application\Command\CreateUserCommand;
use Robertke\User\Application\Handler\CreateUserHandler;

/**
 * Class handlerServiceProvider
 * @package Robertke\User\Infrastructure
 */
class HandlerServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['commands.handlers'] = [
            CreateUserCommand::class => 'handler.user_create',
        ];

        $pimple['handler.user_create'] = function (Container $pimple) {
            return new CreateUserHandler(
                $pimple['repository.user']
            );
        };
    }
}
