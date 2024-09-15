<?php
declare(strict_types=1);

namespace Context\User\Application\BusHandlers\Handler\Credentials;

use Context\User\Application\PublicApi\Command\Credentials\TryToUpgradeHashingAlgorithm;
use Context\User\Domain\Entity\Credentials\LoginAndPassword;
use Context\User\Domain\Exception\Entity\Credentials\CannotUpgradePasswordHashException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooShortException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooSimpleException;
use Context\User\Domain\Repository\Entity\Credentials\CredentialRepositoryInterface;
use Context\User\Domain\ValueObject\Credentials\CredentialId;
use Context\User\Domain\ValueObject\Credentials\Password\Password;
use SharedKernel\Domain\Exception\Repository\NotFoundException;
use SharedKernel\Domain\Exception\ValueObject\InvalidIdException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * @internal
 */
#[AsMessageHandler]
class TryToUpgradeHashingAlgorithmHandler
{

    public function __construct(
        private readonly CredentialRepositoryInterface $credentialRepository,
    )
    {

    }

    public function __invoke(TryToUpgradeHashingAlgorithm $command): void
    {
        try {
            $credential = $this->credentialRepository->ofId(CredentialId::fromString($command->getCredentialId()));
        } catch (InvalidIdException | NotFoundException) {
            return;
        }

        if (!($credential instanceof LoginAndPassword)) {
            return;
        }

        try {
            $credential->upgradePasswordHash(new Password($command->getPassword()));
        } catch (
            PasswordTooShortException|
            PasswordTooSimpleException|
            CannotUpgradePasswordHashException
        ) {
            return;
        }

        $this->credentialRepository->persist($credential);
    }
}