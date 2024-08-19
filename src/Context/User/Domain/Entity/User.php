<?php
declare(strict_types=1);

namespace Context\User\Domain\Entity;

use Context\User\Domain\ValueObject\HashedPassword;
use Context\User\Domain\ValueObject\UserId;
use Symfony\Component\Uid\Uuid;

final class User
{

    private UserId $id;

    public function __construct(
        private readonly string $username,
        private HashedPassword  $hashedPassword,
    )
    {
        $this->id = new UserId(Uuid::v4());
    }

    public static function reconstitute(
        UserId $id,
        self $user
    ): self
    {
        $user->id = $id;
        return $user;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function hashedPassword(): HashedPassword
    {
        return $this->hashedPassword;
    }

    public function changePassword(HashedPassword $newPassword): void
    {
        $this->hashedPassword = $newPassword;
    }
}