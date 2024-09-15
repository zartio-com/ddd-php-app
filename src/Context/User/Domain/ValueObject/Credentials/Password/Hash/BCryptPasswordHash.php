<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject\Credentials\Password\Hash;

use Context\User\Domain\ValueObject\Credentials\Password\Password;
use JetBrains\PhpStorm\Immutable;
use Override;

/**
 * @internal
 */
#[Immutable]
readonly class BCryptPasswordHash implements PasswordHashInterface
{

    public function __construct(
        private string $hash,
    )
    {

    }

    public static function fromPassword(string|Password $password): self
    {
        if ($password instanceof Password) {
            $password = $password->toString();
        }

        return new self(password_hash($password, PASSWORD_BCRYPT));
    }

    #[Override] public function equals(PasswordHashInterface $otherPasswordHash): bool
    {
        if (!($otherPasswordHash instanceof self)) {
            return false;
        }

        return $this->hash === $otherPasswordHash->hash;
    }

    #[Override] public function isHashOf(string|Password $password): bool
    {
        if ($password instanceof Password) {
            $password = $password->toString();
        }

        return password_verify($password, $this->hash);
    }
}