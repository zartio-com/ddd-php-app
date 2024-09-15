<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Query\Credentials;

use Context\User\Application\BusHandlers\Query\Credentials\WithLoginAndPasswordHandler;
use SensitiveParameter;

/**
 * @see WithLoginAndPasswordHandler::__invoke()
 */
readonly class WithLoginAndPassword
{

    public function __construct(
        private string $login,
        #[SensitiveParameter]
        private string $password,
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
}