<?php
declare(strict_types=1);

namespace Context\User\Application\Factory\DTO\Output;

use Context\User\Application\Exception\Factory\DTO\Output\Credential\UnhandledCredentialImplementationException;
use Context\User\Domain\Aggregate\User;
use Context\User\Domain\Entity\Credentials\CredentialInterface;

class UserFactory
{

    public function __construct(
        private readonly CredentialFactory $credentialFactory,
    )
    {

    }


    /**
     * @throws UnhandledCredentialImplementationException
     */
    public function build(User $user): \Context\User\Application\PublicApi\DTO\User
    {
        return new \Context\User\Application\PublicApi\DTO\User(
            id: $user->userId()->toString(),
            credentials: $user->credentials()->map(
                fn (CredentialInterface $credential) => $this->credentialFactory->build($credential))->toArray()
        );
    }
}