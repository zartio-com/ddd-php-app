<?php
declare(strict_types=1);

namespace Context\User\Application\MessageBus\Query;

use Context\User\Domain\ValueObject\UserId;

readonly class UserOfId
{

    public function __construct(
        private UserId $id,
    )
    {

    }

    public function getId(): UserId
    {
        return $this->id;
    }
}