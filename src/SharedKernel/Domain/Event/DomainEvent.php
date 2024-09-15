<?php

namespace SharedKernel\Domain\Event;

use SharedKernel\Domain\ValueObject\Time\Timestamp;

readonly abstract class DomainEvent
{

    protected function __construct(
        private Timestamp $occurredAt,
    )
    {

    }

    public function occurredAt(): Timestamp
    {
        return $this->occurredAt;
    }
}