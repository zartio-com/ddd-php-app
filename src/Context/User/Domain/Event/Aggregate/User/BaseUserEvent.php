<?php
declare(strict_types=1);

namespace Context\User\Domain\Event\Aggregate\User;

use Context\User\Domain\ValueObject\UserId;
use SharedKernel\Domain\Event\DomainEvent;
use SharedKernel\Domain\ValueObject\Time\Timestamp;

/**
 * @internal
 */
readonly abstract class BaseUserEvent extends DomainEvent
{

    protected function __construct(
        private UserId $userId,
        Timestamp      $occurredAt,
    )
    {
        parent::__construct($occurredAt);
    }

    public function getCredentialId(): string
    {
        return $this->userId->toString();
    }
}