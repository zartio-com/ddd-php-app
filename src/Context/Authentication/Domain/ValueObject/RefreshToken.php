<?php
declare(strict_types=1);

namespace Context\Authentication\Domain\ValueObject;

/**
 * @internal
 */
readonly class RefreshToken
{

    private function __construct(
        private string $refreshToken,
    )
    {

    }

    public static function create(): self
    {
        return new self(base64_encode(random_bytes(64))); // todo what to do with the exception?
    }

    public function toString(): string
    {
        return $this->refreshToken;
    }

    public function equals(self $otherRefreshToken): bool
    {
        return $this->refreshToken === $otherRefreshToken->refreshToken;
    }
}