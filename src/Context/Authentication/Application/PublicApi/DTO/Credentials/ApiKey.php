<?php

namespace Context\Authentication\Application\PublicApi\ValueObject\Credentials;

class ApiKey implements CredentialInterface
{

    public function jsonSerialize(): mixed
    {
        return null;
    }
}