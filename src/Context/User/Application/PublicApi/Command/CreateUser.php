<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Command;

use Context\User\Application\BusHandlers\Handler\CreateUserHandler;
use Context\User\Application\PublicApi\Query\NewUserId;

/**
 * @see CreateUserHandler::__invoke()
 * You can provide pre-generated user id obtained from query @see NewUserId
 * or, you can pass null, and it will be generated. Useful if you don't care
 * about the command result and need just the id.
 */
final readonly class CreateUser
{

    public function __construct(
        private ?string $userId = null,
    )
    {

    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }
}