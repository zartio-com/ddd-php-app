<?php
declare(strict_types=1);

namespace Context\User\Domain\Exception\ValueObject\Credentials;

use Throwable;

/**
 * @internal
 */
class LoginContainsInvalidCharacters extends LoginException
{

    public function __construct(
        string $providedValue,
        ?Throwable $previous = null,
    )
    {
        parent::__construct(
            message: "Value (\"{$providedValue}\") contains illegal characters, only alphanumeric and underscore characters are allowed.",
            previous: $previous
        );
    }
}