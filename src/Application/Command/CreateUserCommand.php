<?php


namespace Robertke\User\Application\Command;


final class CreateUserCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * CreateUserCommand constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
}