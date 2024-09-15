<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\DTO;

use Context\User\Application\PublicApi\DTO\Credentials\ApiKey;
use Context\User\Application\PublicApi\DTO\Credentials\CredentialInterface;
use Context\User\Application\PublicApi\DTO\Credentials\LoginAndPassword;
use Context\User\Domain;

readonly class User
{

    /** @param CredentialInterface[] $credentials */
    public function __construct(
        private string $id,
        private array $credentials,
    )
    {

    }

    public static function fromDomain(Domain\Aggregate\User $user): self
    {
        return new self(
            id: $user->userId()->toString(),
            credentials: $user->credentials() // @phpstan-ignore-line
                ->map(static fn (Domain\Entity\Credentials\CredentialInterface $credential) => match(get_class($credential)) {
                    Domain\Entity\Credentials\LoginAndPassword::class => LoginAndPassword::fromDomain($credential),
                    Domain\Entity\Credentials\ApiKey::class => ApiKey::fromDomain($credential),
                    default => throw new \Exception(), // TODO
                })
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    /** @return CredentialInterface[] */
    public function getCredentials(): array
    {
        return $this->credentials;
    }
}