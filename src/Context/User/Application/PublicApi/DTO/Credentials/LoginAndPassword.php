<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\DTO\Credentials;

use Context\User\Domain;

final readonly class LoginAndPassword implements CredentialInterface
{

    public function __construct(
        private string $id,
        private string $login,
    )
    {

    }

    public static function fromDomain(Domain\Entity\Credentials\LoginAndPassword $credential): self
    {
        return new self(
            id: $credential->id()->toString(),
            login: $credential->login()->toString(),
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }
}