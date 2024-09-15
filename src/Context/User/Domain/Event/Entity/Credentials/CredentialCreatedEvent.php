<?php
declare(strict_types=1);

namespace Context\User\Domain\Event\Entity\Credentials;

use Context\User\Domain\ValueObject\Credentials\CredentialId;
use SharedKernel\Domain\ValueObject\Time\Timestamp;

readonly class CredentialCreatedEvent extends BaseCredentialEvent
{

    private function __construct(
        CredentialId $credentialId,
        Timestamp    $occurredAt,
    )
    {
        parent::__construct($credentialId, $occurredAt);
    }

    /** @internal */
    public static function occurred(
        CredentialId $credentialId,
    ): self
    {
        return new self(
            credentialId: $credentialId,
            occurredAt: Timestamp::now(),
        );
    }
}