<?php

namespace Context\User\Domain\Entity\Credentials;

use Context\User\Domain\ValueObject\Credentials\CredentialId;

/**
 * @internal
 */
interface CredentialInterface
{

    public function id(): CredentialId;
}