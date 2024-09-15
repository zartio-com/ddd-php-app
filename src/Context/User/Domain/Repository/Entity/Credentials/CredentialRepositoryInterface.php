<?php

namespace Context\User\Domain\Repository\Entity\Credentials;

use Context\User\Domain\Entity\Credentials\ApiKey;
use Context\User\Domain\Entity\Credentials\CredentialInterface;
use Context\User\Domain\Entity\Credentials\LoginAndPassword;
use Context\User\Domain\ValueObject\Credentials\CredentialId;
use Context\User\Domain\ValueObject\Credentials\Login;
use SharedKernel\Domain\Exception\Repository\NotFoundException;

interface CredentialRepositoryInterface
{

    public function persist(CredentialInterface $credential): void;

    /**
     * @throws NotFoundException
     */
    public function ofId(CredentialId $credentialId): CredentialInterface;

    /**
     * @throws NotFoundException
     */
    public function findOneByLogin(Login $login): LoginAndPassword;

    public function findByApiKey(string $apiKey): ?ApiKey;
}