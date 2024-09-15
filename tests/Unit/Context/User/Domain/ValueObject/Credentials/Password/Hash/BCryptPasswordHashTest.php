<?php
declare(strict_types=1);

namespace Test\Unit\Context\User\Domain\ValueObject\Credentials\Password\Hash;

use Context\User\Domain\ValueObject\Credentials\Password\Hash\BCryptPasswordHash;
use Override;

/**
 * @internal
 *
 * This test is expensive due to the way how bcrypt algorithm works.
 * @group expensive
 */
class BCryptPasswordHashTest extends PasswordHashTestCase
{

    //<editor-fold desc="Whens">
    #[Override] protected function whenPasswordIsHashed(): void
    {
        if (!isset($this->password)) {
            return;
        }

        $this->passwordHash = BCryptPasswordHash::fromPassword($this->password);
    }

    #[Override] protected function whenAnotherPasswordIsHashed(): void
    {
        if (!isset($this->otherPassword)) {
            return;
        }

        $this->otherPasswordHash = BCryptPasswordHash::fromPassword($this->otherPassword);
    }
    //</editor-fold>

}