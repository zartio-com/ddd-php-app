<?php
declare(strict_types=1);

namespace Context\User\Domain\Aggregate;

use Context\User\Domain\Entity\Credentials\CredentialInterface;
use Context\User\Domain\Event\Aggregate\User\CredentialAddedEvent;
use Context\User\Domain\Event\Aggregate\User\UserCreatedEvent;
use Context\User\Domain\Exception\Aggregate\User\CredentialOfIdDoesNotExist;
use Context\User\Domain\Exception\Aggregate\User\UserCanNotHaveNoCredentials;
use Context\User\Domain\ValueObject\Credentials\CredentialId;
use Context\User\Domain\ValueObject\UserId;
use Munus\Collection\Set;
use SharedKernel\Domain\Entity\DomainEntity;

/**
 * @internal
 */
final class User extends DomainEntity
{

    /**
     * @param Set<CredentialInterface> $credentials
     * @throws UserCanNotHaveNoCredentials
     */
    private function __construct(
        private readonly UserId $userId,
        private Set $credentials,
    )
    {
        if ($this->credentials->length() < 1) {
            throw new UserCanNotHaveNoCredentials();
        }
    }

    /**
     * @param Set<CredentialInterface> $credentials
     * @throws UserCanNotHaveNoCredentials
     */
    public static function create(
        Set $credentials
    ): self
    {
        $user = new self(
            userId: UserId::create(),
            credentials: $credentials,
        );

        $user->recordEvent(UserCreatedEvent::occurred($user->userId));

        return $user;
    }

    /**
     * @param Set<CredentialInterface> $credentials
     * @throws UserCanNotHaveNoCredentials
     */
    public static function reconstitute(
        UserId $userId,
        Set $credentials,
    ): self
    {
        return new self(
            userId: $userId,
            credentials: $credentials,
        );
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return Set<CredentialInterface>
     */
    public function credentials(): Set
    {
        return $this->credentials;
    }

    /**
     * @throws CredentialOfIdDoesNotExist
     */
    public function credentialOfId(CredentialId $credentialId): CredentialInterface
    {
        $credential = $this->credentials
            ->filter(static fn(CredentialInterface $credential) => $credential->id()->equals($credentialId))
            ->findFirst()
            ->getOrNull();

        if ($credential === null) {
            throw new CredentialOfIdDoesNotExist($credentialId);
        }

        return $credential;
    }

    public function addCredential(CredentialInterface $credential): void
    {
        $this->credentials = $this->credentials->add($credential);

        $this->recordEvent(CredentialAddedEvent::occurred($this->userId, $credential->id()));
    }

    /**
     * @throws CredentialOfIdDoesNotExist
     * @throws UserCanNotHaveNoCredentials
     */
    public function removeCredentialOfId(CredentialId $credentialId): void
    {
        $credential = $this->credentialOfId($credentialId);

        if ($this->credentials->length() <= 1) {
            throw new UserCanNotHaveNoCredentials();
        }

        $this->credentials = $this->credentials->remove($credential);
    }
}