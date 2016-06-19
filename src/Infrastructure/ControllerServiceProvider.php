<?php

namespace Robertke\User\Infrastructure;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Robertke\User\Application\Controller\UsersController;

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
        $app['users.controller'] = function() {
            return new UsersController();
        };
    }
}