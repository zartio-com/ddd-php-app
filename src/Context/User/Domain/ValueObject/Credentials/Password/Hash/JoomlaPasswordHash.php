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
readonly class JoomlaPasswordHash implements PasswordHashInterface
{

    public function __construct(
        private string $hash,
        private string $salt,
    )
    {

    }

    public static function fromPasswordAndSalt(string|Password $password, string $salt): self
    {
        if ($password instanceof Password) {
            $password = $password->toString();
        }

        return new self(md5("$password.$salt"), $salt);
    }

    #[Override] public function equals(PasswordHashInterface $otherPasswordHash): bool
    {
        if (!($otherPasswordHash instanceof JoomlaPasswordHash)) {
            return false;
        }

        return $this->hash === $otherPasswordHash->hash
            && $this->salt === $otherPasswordHash->salt;
    }

    #[Override] public function isHashOf(string|Password $password): bool
    {
        if ($password instanceof Password) {
            $password = $password->toString();
        }

        return self::fromPasswordAndSalt($password, $this->salt)->hash === $this->hash;
    }
}