<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\DTO\Credentials;

use Context\User\Domain;

final readonly class ApiKey implements CredentialInterface
{

    public function __construct(
        private string $id,
        private string $apiKey,
    )
    {

    }

    public static function fromDomain(Domain\Entity\Credentials\ApiKey $credential): self
    {
        return new self(
            id: $credential->id()->toString(),
            apiKey: $credential->apiKey()->toString(),
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}