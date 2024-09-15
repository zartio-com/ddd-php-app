<?php
declare(strict_types=1);

namespace Context\Authentication\UI\RestApi\Admin\V1\DTO\Request;

use Context\User\Application\PublicApi\Validation\Constraints as UserAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @internal
 */
readonly class Authenticate
{

    public function __construct(
        #[Assert\NotNull]
        #[UserAssert\Credentials\Login]
        private string $login,

        #[Assert\NotNull]
        private string $password,

        #[Assert\NotNull]
        #[Assert\Length(min: 32)]
        private string $fingerprint,
    )
    {

    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }
}