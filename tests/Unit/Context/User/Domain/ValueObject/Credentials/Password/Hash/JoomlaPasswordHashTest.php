<?php
declare(strict_types=1);

namespace Test\Unit\Context\User\Domain\ValueObject\Credentials\Password\Hash;

use Context\User\Domain\ValueObject\Credentials\Password\Hash\JoomlaPasswordHash;

/**
 * @internal
 */
class JoomlaPasswordHashTest extends PasswordHashTestCase
{

    //<editor-fold desc="Whens">
    #[\Override] protected function whenPasswordIsHashed(): void
    {
        if (!isset($this->password)) {
            return;
        }

        $this->passwordHash = JoomlaPasswordHash::fromPasswordAndSalt($this->password, 'static');
    }

    #[\Override] protected function whenAnotherPasswordIsHashed(): void
    {
        if (!isset($this->otherPassword)) {
            return;
        }

        $this->otherPasswordHash = JoomlaPasswordHash::fromPasswordAndSalt($this->otherPassword, 'static');
    }
    //</editor-fold>
}