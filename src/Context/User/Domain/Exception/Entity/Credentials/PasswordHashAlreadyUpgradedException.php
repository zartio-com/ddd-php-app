<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\Entity\Credentials;

use SharedKernel\Domain\Exception\DomainException;
use Throwable;

/**
 * @internal
 */
class PasswordHashAlreadyUpgradedException extends DomainException
{

    public function __construct(?Throwable $previous = null)
    {
        parent::__construct(previous: $previous);
    }
}