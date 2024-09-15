<?php
declare(strict_types=1);

namespace Context\User\Application\Factory\DTO\Output;

use Context\User\Application\Exception\Factory\DTO\Output\Credential\UnhandledCredentialImplementationException;
use Context\User\Application\PublicApi\DTO\Credentials\ApiKey;
use Context\User\Application\PublicApi\DTO\Credentials\LoginAndPassword;
use Context\User\Domain\Entity\Credentials\CredentialInterface;

use Context\User\Domain\Entity\Credentials as DomainCredential;

class CredentialFactory
{

    /**
     * @throws UnhandledCredentialImplementationException
     */
    public function build(CredentialInterface $credential): \Context\User\Application\PublicApi\DTO\Credentials\CredentialInterface
    {
        return match(get_class($credential)) {
            DomainCredential\LoginAndPassword::class =>
                new LoginAndPassword($credential->id()->toString(), $credential->login()->toString()),
            DomainCredential\ApiKey::class =>
                new ApiKey($credential->id()->toString(), $credential->apiKey()->toString()),

            default => throw new UnhandledCredentialImplementationException(get_class($credential)),
        };
    }
}