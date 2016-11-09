<?php


namespace Robertke\User\Application\Handler;

use Robertke\User\Application\Command\CreateUserCommand;
use Robertke\User\Domain\User;
use Robertke\User\Domain\UserAlreadyExistException;
use Robertke\User\Domain\UserId;
use Robertke\User\Domain\UserRepositoryInterface;

class CreateUserHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $repo;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $repo
     */
    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function handle(CreateUserCommand $command)
    {
        $user = new User(UserId::fromString(7), $command->getName());

        $existingUser = $this->repo->findById($user->getId());

        if (!empty($existingUser)) {
            throw new UserAlreadyExistException(sprintf('User with such ID: %s already exist', $user->getId()));
        }

        $this->repo->save($user);
    }
}