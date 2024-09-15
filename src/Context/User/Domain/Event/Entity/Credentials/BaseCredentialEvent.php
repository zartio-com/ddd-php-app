<?php
declare(strict_types=1);

namespace Context\User\Domain\Event\Entity\Credentials;

use Context\User\Domain\ValueObject\Credentials\CredentialId;
use SharedKernel\Domain\Event\DomainEvent;
use SharedKernel\Domain\ValueObject\Time\Timestamp;

/**
 * @internal
 */
readonly abstract class BaseCredentialEvent extends DomainEvent
{

    protected function __construct(
        private CredentialId $credentialId,
        Timestamp            $occurredAt,
    )
    {
        parent::__construct($occurredAt);
    }

    public function getCredentialId(): string
    {
        return $this->credentialId->toString();
    }
}