<?php
declare(strict_types=1);

namespace Context\User\Application\PublicApi\Command\Credentials;

use Context\User\Application\BusHandlers\Handler\Credentials\TryToUpgradeHashingAlgorithmHandler;

/**
 * @see TryToUpgradeHashingAlgorithmHandler::__invoke()
 */
final readonly class TryToUpgradeHashingAlgorithm
{

    public function __construct(
        private string $credentialId,
        private string $password,
    )
    {

    }

    public function getCredentialId(): string
    {
        return $this->credentialId;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}