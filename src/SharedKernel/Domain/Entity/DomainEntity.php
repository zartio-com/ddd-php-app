<?php
declare(strict_types=1);

namespace SharedKernel\Domain\Entity;

use SharedKernel\Domain\Event\DomainEvent;

abstract class DomainEntity
{

    /** @var DomainEvent[] */
    private array $occurredEvents = [];

    protected function recordEvent(DomainEvent $event): void
    {
        $this->occurredEvents[] = $event;
    }

    public function retrieveEventForDispatch(): ?DomainEvent
    {
        return array_shift($this->occurredEvents);
    }
}