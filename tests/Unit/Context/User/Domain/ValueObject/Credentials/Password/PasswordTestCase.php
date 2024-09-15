<?php
declare(strict_types=1);

namespace Test\Unit\Context\User\Domain\ValueObject\Credentials\Password;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class PasswordTestCase extends TestCase
{

    public function provideValidPasswords(): array
    {
        return [
            ['1234123#'],
            ['12341234#'],
        ];
    }
}