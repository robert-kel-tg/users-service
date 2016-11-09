<?php

namespace Robertke\User\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class DoctrineServiceProvider
 * @package Robertke\User\Infrastructure
 */
class DoctrineServiceProvider implements ServiceProviderInterface
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
        Type::addType('user_id', UserIdType::class);

        $entityManager = EntityManager::create(
            [
                'driver'   => 'pdo_mysql',
                'host' => 'mysql',
                'port' => '3306',
                'user'     => 'demoUser',
                'password' => 'demoPass',
                'dbname'   => 'demoDb',
            ],
            Setup::createXMLMetadataConfiguration(["../src/Infrastructure/Persistence/Doctrine"], true)
        );

        $pimple['repository.user'] = function () use ($pimple, $entityManager) {
            return new UserRepository($entityManager);
        };
    }
}
