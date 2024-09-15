<?php

namespace Context\Authentication\Application\PublicApi\ValueObject\Credentials;

use JetBrains\PhpStorm\ArrayShape;

class LoginAndPassword implements CredentialInterface
{

    public function __construct(
        private string $login,

        #[\SensitiveParameter]
        private string $password,
    )
    {

    }

    public function login(): string
    {
        return $this->login;
    }

    public function password(): string
    {
        return $this->password;
    }

    #[ArrayShape([
        'login' => 'string',
        'password' => 'string',
    ])]
    public function jsonSerialize(): array
    {
        return [
            'login' => $this->login,
            'password' => $this->password,
        ];
    }
}