<?php
declare(strict_types=1);

namespace Context\User\Application\MessageBus\Query\Handler;

use Context\User\Application\MessageBus\Query\UserOfId;
use Context\User\Domain\Entity\User;
use Context\User\Infrastructure\Persistence\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * @internal
 */
#[AsMessageHandler]
final class UserOfIdHandler
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {

    }

    public function __invoke(UserOfId $query): ?User
    {
        return $this->userRepository->userOfId($query->getId());
    }
}