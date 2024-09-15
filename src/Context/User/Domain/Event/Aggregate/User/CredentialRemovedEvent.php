<?php
declare(strict_types=1);

namespace Context\User\Domain\Event\Aggregate\User;

use Context\User\Domain\ValueObject\Credentials\CredentialId;
use Context\User\Domain\ValueObject\UserId;
use SharedKernel\Domain\ValueObject\Time\Timestamp;

readonly class CredentialRemovedEvent extends BaseUserEvent
{

    private function __construct(
        UserId               $userId,
        private CredentialId $credentialId,
        Timestamp            $occurredAt,
    )
    {
        parent::__construct($userId, $occurredAt);
    }

    /** @internal */
    public static function occurred(
        UserId $userId,
        CredentialId $credentialId,
    ): self
    {
        return new self(
            userId: $userId,
            credentialId: $credentialId,
            occurredAt: Timestamp::now(),
        );
    }

    public function getCredentialId(): string
    {
        return $this->credentialId->toString();
    }
}