<?php
declare(strict_types=1);

namespace Context\Authentication\Application\PublicApi\Command\Handler;

use Context\Authentication\Application\PublicApi\Command\Authenticate;
use Context\Authentication\Application\PublicApi\ValueObject\Credentials\LoginAndPassword;
use Context\User\Application\PublicApi\Query\FindByLogin;
use Context\User\Domain\ValueObject\Credentials\Password\Password;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @internal
 */
#[AsMessageHandler]
class AuthenticateHandler
{

    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
    )
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Authenticate $command): mixed
    {
        $credential = $command->credential();

        if ($credential instanceof LoginAndPassword) {
            $credentialObject = $this->handle(new FindByLogin($credential->login()));
            if ($credentialObject === null) {
                throw new \Exception('blabla');
            }

            if (!$credentialObject->passwordHash()->isHashOf(new Password($credential->password()))) {
                throw new \Exception('zle haslo');
            }

            // OK
        }

        throw new \Exception('Unsupported authentication credentials');
    }
}