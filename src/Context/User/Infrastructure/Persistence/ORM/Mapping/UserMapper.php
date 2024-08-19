<?php

namespace Context\User\Infrastructure\Persistence\ORM\Mapping;

use Context\User\Domain\Entity\User;
use Context\User\Domain\ValueObject\UserId;
use Context\User\Infrastructure\Persistence\ORM\Entity\User as ORMUser;

class UserMapper
{

    public function toDomain(ORMUser $user): User
    {
        return User::reconstitute(
            new UserId($user->getId()),
            new User(
                $user->getUsername()
            )
        );
    }

    public function toORM(User $user): ORMUser
    {
        return new ORMUser(
            $user->id()->getValue(),
            $user->username(),
        );
    }
}