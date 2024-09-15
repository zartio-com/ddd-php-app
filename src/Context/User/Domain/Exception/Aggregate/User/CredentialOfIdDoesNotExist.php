<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\Aggregate\User;

use Context\User\Domain\ValueObject\Credentials\CredentialId;
use SharedKernel\Domain\Exception\DomainException;
use Throwable;

/**
 * @internal
 */
class CredentialOfIdDoesNotExist extends DomainException
{

    public function __construct(CredentialId $providedId, ?Throwable $previous = null)
    {
        parent::__construct(
            message: "Credential with provided id of \"{$providedId->toString()}\" does not exist.",
            previous: $previous
        );
    }
}