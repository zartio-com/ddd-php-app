<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\DTO\Input;

use Context\User\Application\PublicApi\Query\NewUserId;

readonly class UserId
{

    /**
     * @internal
     * @see NewUserId
     */
    public function __construct(
        private string $userId
    )
    {

    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}