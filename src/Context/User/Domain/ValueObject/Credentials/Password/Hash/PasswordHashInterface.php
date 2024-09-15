<?php
declare(strict_types=1);

namespace Context\User\Domain\ValueObject\Credentials\Password\Hash;

use Context\User\Domain\ValueObject\Credentials\Password\Password;
use JetBrains\PhpStorm\Immutable;

/**
 * @internal
 */
#[Immutable]
interface PasswordHashInterface
{

    public function equals(self $otherPasswordHash): bool;

    public function isHashOf(string|Password $password): bool;
}