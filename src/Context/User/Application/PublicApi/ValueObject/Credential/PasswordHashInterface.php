<?php

namespace Context\User\Application\PublicApi\ValueObject\Credential;

interface PasswordHashInterface
{

    public function isHashOf(string $password): bool;
}