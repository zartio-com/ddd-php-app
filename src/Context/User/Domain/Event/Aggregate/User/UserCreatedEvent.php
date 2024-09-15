<?php
declare(strict_types=1);

namespace Context\User\Domain\Event\Aggregate\User;

use Context\User\Domain\ValueObject\UserId;
use SharedKernel\Domain\ValueObject\Time\Timestamp;

readonly class UserCreatedEvent extends BaseUserEvent
{

    private function __construct(
        UserId    $userId,
        Timestamp $occurredAt,
    )
    {
        parent::__construct($userId, $occurredAt);
    }

    /** @internal */
    public static function occurred(
        UserId $userId,
    ): self
    {
        return new self(
            userId: $userId,
            occurredAt: Timestamp::now(),
        );
    }
}