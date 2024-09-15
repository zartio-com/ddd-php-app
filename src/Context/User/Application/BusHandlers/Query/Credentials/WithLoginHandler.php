<?php
declare(strict_types=1);

namespace Context\User\Application\BusHandlers\Query\Credentials;

use Context\User\Application\PublicApi\DTO;
use Context\User\Application\PublicApi\Query\Credentials\WithLogin;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginException;
use Context\User\Domain\Repository\Entity\Credentials\CredentialRepositoryInterface;
use Context\User\Domain\ValueObject\Credentials\Login;
use SharedKernel\Domain\Exception\Repository\NotFoundException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * @internal
 */
#[AsMessageHandler]
class WithLoginHandler
{

    public function __construct(
        private readonly CredentialRepositoryInterface $credentialRepository,
    )
    {

    }

    public function __invoke(WithLogin $query): ?DTO\Credentials\LoginAndPassword
    {
        try {
            $credential = $this->credentialRepository->findOneByLogin(new Login($query->getLogin()));
        } catch (LoginException | NotFoundException) {
            return null;
        }

        return DTO\Credentials\LoginAndPassword::fromDomain($credential);
    }
}