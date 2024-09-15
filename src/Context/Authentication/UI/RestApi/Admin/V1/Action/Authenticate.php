<?php
declare(strict_types=1);

namespace Context\Authentication\UI\RestApi\Admin\V1\Action;

use Context\Authentication\UI\RestApi\Admin\DTO\Request;
use Context\User\Application\PublicApi as UserPublicApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @internal
 */
#[AsController]
final class Authenticate
{

    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
    )
    {
        $this->messageBus = $messageBus;
    }

    #[Route(path: '/authentication/authenticate', name: 'Authenticate', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] \Context\Authentication\UI\RestApi\Admin\V1\DTO\Request\Authenticate $request
    ): Response
    {
        $credential = $this->handle(new UserPublicApi\Query\Credentials\WithLoginAndPassword(
            login: $request->getLogin(),
            password: $request->getPassword(),
        ));
        if ($credential === null) {
            return new JsonResponse(status: Response::HTTP_NOT_FOUND);
        }

        try {
            /**
             * This is not a critical operation to the authentication process,
             * dispatch the message asynchronously.
             */
            $this->messageBus->dispatch(new UserPublicApi\Command\Credentials\TryToUpgradeHashingAlgorithm(
                credentialId: $credential->getId(),
                password: $request->getPassword(),
            ));
        } catch (ExceptionInterface) {
            // todo: maybe just a log to report a potential problem.
        }

        return new JsonResponse(); // TODO: Issue access token
    }
}