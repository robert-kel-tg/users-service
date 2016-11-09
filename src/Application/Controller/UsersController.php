<?php

namespace Robertke\User\Application\Controller;

use Doctrine\DBAL\Driver\Connection;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use League\Tactician\CommandBus;
use Robertke\User\Application\Command\CreateUserCommand;
use Robertke\User\Domain\UserId;
use Robertke\User\Domain\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsersController
 * @package Robertke\User
 */
class UsersController
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * UsersController constructor.
     * @param UserRepositoryInterface $userRepo
     * @param CommandBus $commandBus
     * @param SerializerInterface $serializer
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        CommandBus $commandBus,
        SerializerInterface $serializer
    ) {
        $this->userRepo = $userRepo;
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        $users = $this->userRepo->findAll();

        $serializedUsers = $this->serializer->serialize($users, 'json');

        $view = ['data' => json_decode($serializedUsers), 'status' => Response::HTTP_OK];

        return new JsonResponse($view, Response::HTTP_OK);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function getById(string $id): JsonResponse
    {
        $user = $this->userRepo->findById(UserId::fromString($id));

        $serializedUser = $this->serializer->serialize($user, 'json');

        $view = ['data' => json_decode($serializedUser), 'status' => Response::HTTP_OK];

        return new JsonResponse($view, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request) {

        $command = new CreateUserCommand($request->request->get('name'));

        try {
            $this->commandBus->handle($command);

        } catch(\DomainException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse('OK', Response::HTTP_CREATED);
    }
}
