<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\ValueObject\Credentials;

use Throwable;

/**
 * @internal
 */
class LoginTooShortException extends LoginException
{

    public function __construct(
        string $providedValue,
        ?Throwable $previous = null,
    )
    {
        parent::__construct(
            message: "Value (\"{$providedValue}\") is too short.",
            previous: $previous
        );
    }
}