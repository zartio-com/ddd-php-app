<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\ValueObject\Credentials\Password;

use SharedKernel\Domain\Exception\DomainException;
use Throwable;

/**
 * @internal
 */
class PasswordException extends DomainException
{

    public function __construct(
        string $message,
        ?Throwable $previous = null,
    )
    {
        parent::__construct(
            message: $message,
            previous: $previous
        );
    }
}