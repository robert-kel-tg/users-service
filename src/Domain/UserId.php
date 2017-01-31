<?php

namespace Robertke\User\Domain;

//Aaaaaa
final class UserId
{
    private $value;

    /**
     * UserId constructor.
     * @param $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    public static function fromString(string $value)
    {
        return new self((int) $value);
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
