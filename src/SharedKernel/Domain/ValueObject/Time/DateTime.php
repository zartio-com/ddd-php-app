<?php

namespace SharedKernel\Domain\ValueObject\Time;

class DateTime
{

    public function __construct(
        private int $timestamp,
    )
    {

    }

    public function isGreaterThan(DateTime $otherDate): bool
    {

    }
}