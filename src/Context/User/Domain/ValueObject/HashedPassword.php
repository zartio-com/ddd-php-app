<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject;

readonly class HashedPassword
{

    public function __construct(
        private string $hash,
    )
    {

    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function matchesPassword(string $password): bool
    {
        return password_verify($password, $this->hash);
    }
}