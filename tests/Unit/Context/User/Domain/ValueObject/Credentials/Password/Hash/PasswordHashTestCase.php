<?php
declare(strict_types=1);

namespace Test\Unit\Context\User\Domain\ValueObject\Credentials\Password\Hash;

use Context\User\Domain\ValueObject\Credentials\Password\Hash\PasswordHashInterface;
use Context\User\Domain\ValueObject\Credentials\Password\Password;
use Exception;
use PHPUnit\Framework\Assert;
use Test\Unit\Context\User\Domain\ValueObject\Credentials\Password\PasswordTestCase;

/**
 * @internal
 */
abstract class PasswordHashTestCase extends PasswordTestCase
{

    protected Password $password;

    protected Password $otherPassword;

    protected PasswordHashInterface $passwordHash;

    protected PasswordHashInterface $otherPasswordHash;

    protected Exception $caughtException;

    /** @dataProvider provideValidPasswords */
    public function testHashOfIsTruthyWhenGivenPasswordOfTheHash(string $password): void
    {
        $this->givenPassword($password);

        $this->whenPasswordIsHashed();

        $this->thenNoExceptionsWereRaised();
        $this->thenHashOfWillReturnTrueForGivenPassword();
    }

    /** @dataProvider provideValidPasswords */
    public function testEqualsForSamePasswordHashIsTruthy(string $password): void
    {
        $this->givenPassword($password);

        $this->whenPasswordIsHashed();

        $this->thenNoExceptionsWereRaised();
        $this->thenEqualsWillReturnTrueForSameHash();
    }

    /** @dataProvider provideValidPasswords */
    public function testEqualsForDifferentPasswordHashIsFalsy(string $password): void
    {
        $this->givenPassword($password);
        $this->givenAnotherPassword($password.'a');

        $this->whenPasswordIsHashed();
        $this->whenAnotherPasswordIsHashed();

        $this->thenNoExceptionsWereRaised();
        $this->thenEqualsWillReturnFalseForAnotherPasswordHash();
    }

    /** @dataProvider provideValidPasswords */
    public function testEqualsForDifferentPasswordHashingAlgorithmIsFalsy(string $password): void
    {
        $this->givenPassword($password);
        $this->givenAnotherPassword($password);

        $this->whenPasswordIsHashed();
        $this->whenAnotherPasswordIsHashedWithDifferentHashingMethod();

        $this->thenNoExceptionsWereRaised();
        $this->thenEqualsWillReturnFalseForAnotherPasswordHash();
    }

    //<editor-fold desc="Givens">
    protected function givenPassword(string $password): void
    {
        try {
            $this->password = new Password($password);
        } catch (Exception $e) {
            $this->caughtException = $e;
        }
    }

    protected function givenAnotherPassword(string $password): void
    {
        try {
            $this->otherPassword = new Password($password);
        } catch (Exception $e) {
            $this->caughtException = $e;
        }
    }
    //</editor-fold>

    //<editor-fold desc="Whens">
    abstract protected function whenPasswordIsHashed(): void;

    abstract protected function whenAnotherPasswordIsHashed(): void;

    protected function whenAnotherPasswordIsHashedWithDifferentHashingMethod(): void
    {
        if (!isset($this->otherPassword)) {
            return;
        }

        $this->otherPasswordHash = $this->createMock(PasswordHashInterface::class);
    }
    //</editor-fold>

    //<editor-fold desc="Thens">
    protected function thenNoExceptionsWereRaised(): void
    {
        Assert::assertFalse(isset($this->caughtException), 'Expected no exceptions to be raised.');
    }

    protected function thenHashOfWillReturnTrueForGivenPassword(): void
    {
        if (!isset($this->password) || !isset($this->passwordHash)) {
            return;
        }

        Assert::assertTrue($this->passwordHash->isHashOf($this->password));
        Assert::assertTrue($this->passwordHash->isHashOf($this->password->toString()));
    }

    protected function thenEqualsWillReturnTrueForSameHash(): void
    {
        if (!isset($this->passwordHash)) {
            return;
        }

        Assert::assertTrue($this->passwordHash->equals($this->passwordHash));
    }

    protected function thenEqualsWillReturnFalseForAnotherPasswordHash(): void
    {
        if (!isset($this->passwordHash) || !isset($this->otherPasswordHash)) {
            return;
        }

        Assert::assertFalse($this->passwordHash->equals($this->otherPasswordHash));
    }
    //</editor-fold>
}