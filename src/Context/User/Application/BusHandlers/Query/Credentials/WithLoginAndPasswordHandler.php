<?php
declare(strict_types=1);

namespace Context\User\Application\BusHandlers\Query\Credentials;

use Context\User\Application\PublicApi\DTO;
use Context\User\Application\PublicApi\Query\Credentials\WithLoginAndPassword;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooShortException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooSimpleException;
use Context\User\Domain\Repository\Entity\Credentials\CredentialRepositoryInterface;
use Context\User\Domain\ValueObject\Credentials\Login;
use Context\User\Domain\ValueObject\Credentials\Password\Password;
use SharedKernel\Domain\Exception\Repository\NotFoundException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * @internal
 */
#[AsMessageHandler]
class WithLoginAndPasswordHandler
{

    public function __construct(
        private readonly CredentialRepositoryInterface $credentialRepository,
    )
    {

    }

    public function __invoke(WithLoginAndPassword $query): ?DTO\Credentials\LoginAndPassword
    {
        try {
            $credential = $this->credentialRepository->findOneByLogin(new Login($query->getLogin()));
        } catch (LoginException | NotFoundException) {
            return null;
        }

        try {
            if (!$credential->passwordHash()->isHashOf(new Password($query->getPassword()))) {
                return null;
            }
        } catch (PasswordTooShortException | PasswordTooSimpleException) {
            return null;
        }

        return DTO\Credentials\LoginAndPassword::fromDomain($credential);
    }
}