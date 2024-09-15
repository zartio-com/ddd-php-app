<?php
declare(strict_types=1);

namespace Context\User\Application\BusHandlers\Query;

use Context\User\Application\Exception\Factory\DTO\Output\Credential\UnhandledCredentialImplementationException;
use Context\User\Application\Factory\DTO\Output\UserFactory;
use Context\User\Application\PublicApi\DTO;
use Context\User\Application\PublicApi\Query\UserOfId;
use Context\User\Domain\Repository\Aggregate\UserRepositoryInterface;
use Context\User\Domain\ValueObject\UserId;
use SharedKernel\Domain\Exception\Repository\NotFoundException;
use SharedKernel\Domain\Exception\ValueObject\InvalidIdException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * @internal
 */
#[AsMessageHandler]
final class UserOfIdHandler
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory $userFactory,
    )
    {

    }

    public function __invoke(UserOfId $command): ?DTO\User
    {
        try {
            $user = $this->userRepository->userOfId(UserId::fromString($command->userId()));

            return $this->userFactory->build($user);
        } catch (InvalidIdException | NotFoundException) {
            // Do nothing.
        } catch (UnhandledCredentialImplementationException $e) {
            // TODO: Error reporting, cannot create DTO due to unhandled Credential entity
        }

        return null;
    }
}