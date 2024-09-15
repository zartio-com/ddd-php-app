<?php

namespace Context\User\Domain\Repository\Aggregate;

use Context\User\Domain\Aggregate\User;
use Context\User\Domain\ValueObject\Credentials\CredentialId;
use Context\User\Domain\ValueObject\UserId;
use SharedKernel\Domain\Exception\Repository\NotFoundException;

interface UserRepositoryInterface
{

    public function persist(User $user): void;

    /**
     * @throws NotFoundException
     */
    public function userOfId(UserId $userId): User;

    /**
     * @throws NotFoundException
     */
    public function findOneByCredentialId(CredentialId $credentialId): User;
}