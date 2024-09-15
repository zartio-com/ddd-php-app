<?php
declare(strict_types=1);

namespace Context\User\Application\BusHandlers\Handler;

use Context\User\Domain\Repository\Aggregate\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateUserHandler
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {

    }
}