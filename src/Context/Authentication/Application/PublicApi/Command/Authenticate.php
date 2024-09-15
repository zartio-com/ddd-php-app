<?php

namespace Context\Authentication\Application\PublicApi\Command;

use Context\Authentication\Application\PublicApi\ValueObject\Credentials\CredentialInterface;

readonly class Authenticate
{

    public function __construct(
        private CredentialInterface $credential,
    )
    {

    }

    public function credential(): CredentialInterface
    {
        return $this->credential;
    }
}