<?php
declare(strict_types=1);

namespace Context\User\Domain\Entity\Credentials;

use Context\User\Domain\ValueObject as VO;
use Context\User\Domain\ValueObject\Credentials\CredentialId;

/**
 * @internal
 */
class ApiKey implements CredentialInterface
{

    private function __construct(
        private readonly CredentialId $credentialId,
        private VO\Credentials\ApiKey $apiKey,
    )
    {

    }

    public static function create(
    ): self
    {
        return new self(
            credentialId: CredentialId::create(),
            apiKey: VO\Credentials\ApiKey::create(),
        );
    }

    public static function reconstitute(
        CredentialId $credentialId,
        VO\Credentials\ApiKey $apiKey,
    ): self
    {
        return new self(
            credentialId: $credentialId,
            apiKey: $apiKey,
        );
    }

    public function id(): CredentialId
    {
        return $this->credentialId;
    }

    public function apiKey(): VO\Credentials\ApiKey
    {
        return $this->apiKey;
    }
}