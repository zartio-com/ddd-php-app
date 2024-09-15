<?php
declare(strict_types=1);

namespace Test\Unit\Context\User\Domain\ValueObject\Credentials\Password;

use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooShortException;
use Context\User\Domain\Exception\ValueObject\Credentials\Password\PasswordTooSimpleException;
use Context\User\Domain\ValueObject\Credentials\Password\Password;
use Exception;
use PHPUnit\Framework\Assert;

/**
 * @internal
 */
class PasswordTest extends PasswordTestCase
{

    private Password $password;

    private Password $otherPassword;

    private Exception $caughtException;

    /** @dataProvider provideValidPasswords */
    public function testCanCreateValidPassword(string $password): void
    {
        $this->givenPassword($password);

        $this->thenPasswordWasCreated();
    }

    /** @dataProvider provideTooShortPasswords */
    public function testCanNotCreateTooShortPassword(string $password): void
    {
        $this->givenPassword($password);

        $this->thenPasswordCreationFailedDueToBeingTooShort();
    }

    /** @dataProvider provideTooSimplePasswords */
    public function testCanNotCreateTooSimplePassword(string $password): void
    {
        $this->givenPassword($password);

        $this->thenPasswordCreationFailedDueToBeingTooSimple();
    }

    /** @dataProvider provideValidPasswords */
    public function testEqualsForSamePasswordsIsTruthy(string $password): void
    {
        $this->givenPassword($password);
        $this->givenAnotherPassword($password);

        $this->thenEqualsMethodWillReturnTrueForGivenPasswords();
    }

    /** @dataProvider provideValidPasswords */
    public function testEqualsForDifferentPasswordsIsFalsy(string $password): void
    {
        $this->givenPassword($password);
        $this->givenAnotherPassword('a'.$password);

        $this->thenEqualsMethodWillReturnFalseForGivenPasswords();
    }

    //<editor-fold desc="Data providers">
    public function provideTooShortPasswords(): array
    {
        return [
            ['123123'],
        ];
    }

    public function provideTooSimplePasswords(): array
    {
        return [
            ['12341234'],
            ['asdBsdd_'],
        ];
    }
    //</editor-fold>

    //<editor-fold desc="Givens">
    private function givenPassword(string $password): void
    {
        try {
            $this->password = new Password($password);
        } catch (Exception $e) {
            $this->caughtException = $e;
        }
    }

    private function givenAnotherPassword(string $password): void
    {
        try {
            $this->otherPassword = new Password($password);
        } catch (Exception $e) {
            $this->caughtException = $e;
        }
    }
    //</editor-fold>

    //<editor-fold desc="Thens">
    private function thenPasswordWasCreated(): void
    {
        Assert::assertFalse(isset($this->caughtException), 'Expected no exceptions being thrown');
        Assert::assertTrue(isset($this->password));
    }

    private function thenPasswordCreationFailedDueToBeingTooShort(): void
    {
        Assert::assertTrue(isset($this->caughtException), 'Expected to catch an exception');
        Assert::assertInstanceOf(PasswordTooShortException::class, $this->caughtException);
    }

    private function thenPasswordCreationFailedDueToBeingTooSimple(): void
    {
        Assert::assertTrue(isset($this->caughtException), 'Expected to catch an exception');
        Assert::assertInstanceOf(PasswordTooSimpleException::class, $this->caughtException);
    }

    private function thenEqualsMethodWillReturnTrueForGivenPasswords(): void
    {
        Assert::assertTrue($this->password->equals($this->otherPassword));
        Assert::assertTrue($this->password->equals($this->otherPassword->toString()));
        Assert::assertTrue($this->otherPassword->equals($this->password));
        Assert::assertTrue($this->otherPassword->equals($this->password->toString()));
    }

    private function thenEqualsMethodWillReturnFalseForGivenPasswords(): void
    {
        Assert::assertFalse($this->password->equals($this->otherPassword));
        Assert::assertFalse($this->password->equals($this->otherPassword->toString()));
        Assert::assertFalse($this->otherPassword->equals($this->password));
        Assert::assertFalse($this->otherPassword->equals($this->password->toString()));
    }
    //</editor-fold>
}