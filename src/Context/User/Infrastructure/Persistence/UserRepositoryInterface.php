<?php
declare(strict_types=1);

namespace Context\User\Infrastructure\Persistence;

use Context\User\Domain\Entity\User;
use Context\User\Domain\ValueObject\UserId;

/**
 * @internal
 */
interface UserRepositoryInterface
{

    public function persist(User $user): void;

    public function userOfId(UserId $userId): ?User;
}