<?php
declare(strict_types=1);

namespace Context\User\Domain\Provider;

use Context\User\Domain\ValueObject\Credentials\Password\Hash\BCryptPasswordHash;
use Context\User\Domain\ValueObject\Credentials\Password\Hash\PasswordHashInterface;
use Context\User\Domain\ValueObject\Credentials\Password\Password;

/**
 * @internal
 */
class PasswordHashProvider
{

    public function provideForPassword(Password $password): PasswordHashInterface
    {
        return BCryptPasswordHash::fromPassword($password);
    }
}