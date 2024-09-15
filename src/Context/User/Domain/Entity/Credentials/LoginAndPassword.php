<?php
declare(strict_types=1);

namespace Context\User\Domain\Entity\Credentials;

use Context\User\Domain\Exception\Entity\Credentials\CannotUpgradePasswordHashException;
use Context\User\Domain\Exception\Entity\Credentials\NewPasswordIsSameAsOldPasswordException;
use Context\User\Domain\Provider\PasswordHashProvider;
use Context\User\Domain\ValueObject\Credentials\CredentialId;
use Context\User\Domain\ValueObject\Credentials\Login;
use Context\User\Domain\ValueObject\Credentials\Password\Hash\PasswordHashInterface;
use Context\User\Domain\ValueObject\Credentials\Password\Password;
use SensitiveParameter;

/**
 * @internal
 */
class LoginAndPassword implements CredentialInterface
{

    private function __construct(
        private readonly CredentialId $id,
        private Login $login,
        #[SensitiveParameter]
        private PasswordHashInterface $passwordHash,
    )
    {

    }

    public static function create(
        Login $login,
        PasswordHashInterface $passwordHash,
    ): self
    {
        return new self(
            id: CredentialId::create(),
            login: $login,
            passwordHash: $passwordHash,
        );
    }

    public static function reconstitute(
        CredentialId $credentialId,
        Login $login,
        PasswordHashInterface $passwordHash,
    ): self
    {
        return new self(
            id: $credentialId,
            login: $login,
            passwordHash: $passwordHash,
        );
    }

    public function id(): CredentialId
    {
        return $this->id;
    }

    public function login(): Login
    {
        return $this->login;
    }

    public function passwordHash(): PasswordHashInterface
    {
        return $this->passwordHash;
    }

    public function changeLogin(Login $newLogin): void
    {
        $this->login = $newLogin;
    }

    /**
     * @throws NewPasswordIsSameAsOldPasswordException
     */
    public function changePassword(Password $newPassword): void
    {
        if ($this->passwordHash->isHashOf($newPassword)) {
            throw new NewPasswordIsSameAsOldPasswordException();
        }

        $this->passwordHash = (new PasswordHashProvider())->provideForPassword($newPassword);
    }

    /**
     * @throws CannotUpgradePasswordHashException
     */
    public function upgradePasswordHash(Password $password): void
    {
        if (!$this->passwordHash->isHashOf($password)) {
            throw CannotUpgradePasswordHashException::PasswordMismatch();
        }

        $newPasswordHash = (new PasswordHashProvider())->provideForPassword($password);
        if ($this->passwordHash instanceof $newPasswordHash) {
            throw CannotUpgradePasswordHashException::AlreadyUpgraded();
        }

        $this->passwordHash = $newPasswordHash;
    }
}