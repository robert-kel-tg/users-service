<?php

namespace Robertke\User\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Robertke\User\Domain\User;
use Robertke\User\Domain\UserId;
use Robertke\User\Domain\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package Robertke\User\Infrastructure\Persistence\Doctrine
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('u')->from(User::class, 'u')->getQuery()->getResult();
    }

    /**
     * @param UserId $id
     * @return array
     */
    public function findById(UserId $id)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter(':id', $id->getValue())
            ->getQuery()
            ->getResult();
    }

    /**
     * @param UserId $id
     * @return null|User
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneById(UserId $id)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter(':id', $id->getValue())
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}