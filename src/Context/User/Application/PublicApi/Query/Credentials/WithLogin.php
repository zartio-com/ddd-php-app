<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Query\Credentials;

use Context\User\Application\BusHandlers\Query\Credentials\WithLoginHandler;

/**
 * @see WithLoginHandler::__invoke()
 */
readonly class WithLogin
{

    public function __construct(
        private string $login,
    )
    {

    }

    public function getLogin(): string
    {
        return $this->login;
    }
}