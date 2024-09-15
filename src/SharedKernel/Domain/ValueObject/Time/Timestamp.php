<?php

namespace SharedKernel\Domain\ValueObject\Time;

class Timestamp
{

    public function __construct(
        private int $timestamp,
    )
    {

    }

    public static function now(): self
    {
        return new self(time());
    }

    public function isBefore(Timestamp $otherTimestamp): bool
    {
        return $this->timestamp < $otherTimestamp->timestamp;
    }

    public function isAfter(Timestamp $otherTimestamp): bool
    {
        return $this->timestamp > $otherTimestamp->timestamp;
    }
}