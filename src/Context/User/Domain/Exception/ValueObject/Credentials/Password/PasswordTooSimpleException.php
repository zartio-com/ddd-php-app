<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\ValueObject\Credentials\Password;

use Throwable;

/**
 * @internal
 */
class PasswordTooSimpleException extends PasswordException
{

    public function __construct(
        ?Throwable $previous = null
    )
    {
        parent::__construct(
            message: 'Provided value is too simple',
            previous: $previous
        );
    }
}