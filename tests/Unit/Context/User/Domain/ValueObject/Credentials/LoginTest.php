<?php
declare(strict_types=1);

namespace Test\Unit\Context\User\Domain\ValueObject\Credentials;

use Context\User\Domain\Exception\ValueObject\Credentials\LoginContainsInvalidCharacters;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginException;
use Context\User\Domain\Exception\ValueObject\Credentials\LoginTooShortException;
use Context\User\Domain\ValueObject\Credentials\Login;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class LoginTest extends TestCase
{
    private Login $login;
    private Login $otherLogin;
    private Exception $caughtException;

    /** @dataProvider provideValidLogins */
    public function testCanCreateValidLogin(string $login): void
    {
        $this->givenLogin($login);

        $this->thenLoginWasCreated();
    }

    /** @dataProvider provideTooShortLogins */
    public function testCannotCreateTooShortLogin(string $login): void
    {
        $this->givenLogin($login);

        $this->thenLoginCreationFailedDueToBeingTooShort();
    }

    /** @dataProvider provideLoginsWithInvalidCharacters */
    public function testCannotCreateLoginWithInvalidCharacters(string $login): void
    {
        $this->givenLogin($login);

        $this->thenLoginCreationFailedDueToContainingInvalidCharacters();
    }

    /** @dataProvider provideValidLogins */
    public function testEqualsForSameLoginsIsTruthy(string $login): void
    {
        $this->givenLogin($login);
        $this->andGivenAnotherLogin($login);

        $this->thenEqualsMethodWillReturnTrueForGivenLogins();
    }

    /** @dataProvider provideValidLogins */
    public function testEqualsForDifferentLoginsIsFalsy(string $login): void
    {
        $this->givenLogin($login);
        $this->andGivenAnotherLogin($login.'a');

        $this->thenEqualsMethodWillReturnFalseForGivenLogins();
    }

    //<editor-fold desc="Data providers">
    public function provideValidLogins(): array
    {
        return [
            ['1234'],
            ['1234_'],
            ['1234_abc'],
            ['_abc'],
            ['_Abc'],
            ['AbcA'],
            ['Abc1234'],
        ];
    }

    public function provideTooShortLogins(): array
    {
        return [
            ['abc'],
            ['Abc'],
            ['123'],
            ['_ab'],
            ['_12'],
            ['_1a'],
        ];
    }

    public function provideLoginsWithInvalidCharacters(): array
    {
        return [
            ['abc#'],
            ['Abcż'],
            ['123!'],
            ['_ab.'],
            ['_12]'],
            ['_1a-'],
        ];
    }
    //</editor-fold>

    //<editor-fold desc="Givens">
    private function givenLogin(string $login): void
    {
        try {
            $this->login = new Login($login);
        } catch (LoginException $e) {
            $this->caughtException = $e;
        }
    }

    private function andGivenAnotherLogin(string $login): void
    {
        try {
            $this->otherLogin = new Login($login);
        } catch (LoginException $e) {
            $this->caughtException = $e;
        }
    }
    //</editor-fold>

    //<editor-fold desc="Thens">
    private function thenLoginWasCreated(): void
    {
        $this->assertFalse(isset($this->caughtException), 'Expected no exceptions being thrown.');
        $this->assertTrue(isset($this->login), 'Login was not created');
    }

    private function thenEqualsMethodWillReturnTrueForGivenLogins(): void
    {
        $this->assertTrue($this->login->equals($this->otherLogin));
        $this->assertTrue($this->login->equals($this->otherLogin->toString()));
        $this->assertTrue($this->otherLogin->equals($this->login));
        $this->assertTrue($this->otherLogin->equals($this->login->toString()));
    }

    private function thenEqualsMethodWillReturnFalseForGivenLogins(): void
    {
        $this->assertFalse($this->login->equals($this->otherLogin));
        $this->assertFalse($this->login->equals($this->otherLogin->toString()));
        $this->assertFalse($this->otherLogin->equals($this->login));
        $this->assertFalse($this->otherLogin->equals($this->login->toString()));
    }

    private function thenLoginCreationFailedDueToBeingTooShort(): void
    {
        $this->assertTrue(isset($this->caughtException), 'Expected to catch an exception');
        $this->assertInstanceOf(LoginTooShortException::class, $this->caughtException);
    }

    private function thenLoginCreationFailedDueToContainingInvalidCharacters(): void
    {
        $this->assertTrue(isset($this->caughtException), 'Expected to catch an exception');
        $this->assertInstanceOf(LoginContainsInvalidCharacters::class, $this->caughtException);
    }
    //</editor-fold>
}