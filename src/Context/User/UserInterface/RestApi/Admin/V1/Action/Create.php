<?php

namespace Context\User\UserInterface\RestApi\Admin\V1\Action;

use Context\User\UserInterface\RestApi\Admin\V1\DTO\Request\CreateUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @internal
 */
#[AsController]
final class Create
{

    #[Route(
        path: '/user/create',
        methods: ['POST']
    )]
    public function run(
        #[MapRequestPayload] CreateUser $createUser
    ): JsonResponse
    {
        return new JsonResponse();
    }
}