<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject\Credentials\Password;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooShortException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooSimpleException;
use JetBrains\PhpStorm\Immutable;
use SensitiveParameter;

/**
 * @internal
 */
#[Immutable]
readonly class Password
{

    /**
     * @throws PasswordTooShortException
     * @throws PasswordTooSimpleException
     */
    public function __construct(
        #[SensitiveParameter]
        private string $password,
    )
    {
        if (strlen($this->password) < 8) {
            throw new PasswordTooShortException();
        }

        if (!str_contains($this->password, '#')) {
            throw new PasswordTooSimpleException();
        }
    }

    public function toString(): string
    {
        return $this->password;
    }

    public function equals(string|self $otherPassword): bool
    {
        if ($otherPassword instanceof self) {
            $otherPassword = $otherPassword->password;
        }

        return $this->password === $otherPassword;
    }
}