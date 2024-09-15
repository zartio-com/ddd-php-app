<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject\Credentials;

use Context\User\Domain\Exception\ValueObject\Credentials\LoginContainsInvalidCharacters;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginTooShortException;
use JetBrains\PhpStorm\Immutable;

/**
 * @internal
 */
#[Immutable]
readonly class Login
{

    /**
     * @throws LoginTooShortException
     * @throws LoginContainsInvalidCharacters
     */
    public function __construct(
        private string $login,
    )
    {
        if (strlen($this->login) < 4) {
            throw new LoginTooShortException($this->login);
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->login)) {
            throw new LoginContainsInvalidCharacters($this->login);
        }
    }

    public function equals(
        string|self $otherLogin
    ): bool
    {
        if ($otherLogin instanceof self) {
            return $this->login === $otherLogin->login;
        }

        return $this->login === $otherLogin;
    }

    public function toString(): string
    {
        return $this->login;
    }
}