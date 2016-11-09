<?php

namespace Robertke\User\Infrastructure\Persistence\Pdo;

use Doctrine\DBAL\Driver\Connection;
use Robertke\User\Domain\User;
use Robertke\User\Domain\UserId;
use Robertke\User\Domain\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $database;

    public function __construct(Connection $database)
    {
        $this->database = $database;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM users";

        $users = $this->database->fetchAll($sql);

        return array_map(function ($user) {
            return new User(new UserId($user['id']), $user['name']);
        }, $users);
    }

    public function findById(UserId $id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $user = $this->database->fetchAssoc($sql, [$id->getValue()]);

        return new User(
            new UserId($user['id']),
            $user['name']
        );
    }
}