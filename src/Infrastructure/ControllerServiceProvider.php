<?php

namespace Robertke\User\Infrastructure;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Robertke\User\Application\Controller\UsersController;
use Robertke\User\Infrastructure\Persistence\Doctrine\UserRepository;

/**
 * Class ControllerServiceProvider
 * @package Robertke\User\Infrastructure
 */
class ControllerServiceProvider implements ServiceProviderInterface
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
        $pimple['controller.users'] = function () use ($pimple) {

            return new UsersController($pimple['repository.user'], $pimple['c.command_bus'], $pimple['serializer']);
        };

        $pimple['repository.user'] = function () use ($pimple) {
            return new UserRepository($pimple['db']);
        };
    }
}
