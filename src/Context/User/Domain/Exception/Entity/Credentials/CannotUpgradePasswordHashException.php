<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\Entity\Credentials;

use SharedKernel\Domain\Exception\DomainException;
use Throwable;

/**
 * @internal
 */
class CannotUpgradePasswordHashException extends DomainException
{

    private function __construct(
        string $message = '',
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, previous: $previous);
    }

    public static function PasswordMismatch(): self
    {
        return new self('Password did not match with old hashing method');
    }

    public static function AlreadyUpgraded(): self
    {
        return new self('Password hash is already using latest hashing method');
    }
}