<?php

namespace Robertke\User\Domain;


interface UserRepositoryInterface
{
    public function findAll();

    public function findById(UserId $id);

    public function save(User $user);
}