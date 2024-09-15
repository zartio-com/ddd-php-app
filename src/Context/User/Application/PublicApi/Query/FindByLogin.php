<?php

namespace Context\User\Application\PublicApi\Query;

readonly class FindByLogin
{

    public function __construct(
        private string $login) { }

    public function login(): string
    {
        return $this->login;
    }
}