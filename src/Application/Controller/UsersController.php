<?php

namespace Robertke\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsersController
 * @package Robertke\User
 */
class UsersController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function getAll(Request $request): Response
    {
        var_dump('user');
    }
}