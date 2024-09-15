<?php

namespace SharedKernel\Domain\ValueObject;

use InvalidArgumentException;
use SharedKernel\Domain\Exception\ValueObject\InvalidIdException;
use Symfony\Component\Uid\Uuid;

readonly class Id
{

    public function __construct(
        private Uuid $id,
    )
    {

    }

    public static function create(): static
    {
        return new static(Uuid::v4());
    }

    /**
     * @throws InvalidIdException
     */
    public static function fromString(string $uuid): static
    {
        try {
            return new static(Uuid::fromString($uuid));
        } catch (InvalidArgumentException $e) {
            throw new InvalidIdException(previous: $e);
        }
    }

    public function toString(): string
    {
        return $this->id->toString();
    }

    public function equals(self $otherUserId): bool
    {
        return $this->id->toString() === $otherUserId->id->toString();
    }
}