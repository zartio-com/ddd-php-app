<?php

namespace Context\User\UserInterface\RestApi\Admin\V1\DTO\Request;

readonly class CreateUser
{

    public function __construct(
        private string $username,
    )
    {

    }

    public function getUsername(): string
    {
        return $this->username;
    }
}