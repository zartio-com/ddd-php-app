<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Query;

use Context\User\Application\BusHandlers\Query\UserOfIdHandler;

/**
 * @see UserOfIdHandler::__invoke()
 */
readonly class UserOfId
{

    public function __construct(
        private string $userId,
    )
    {

    }

    public function userId(): string
    {
        return $this->userId;
    }
}