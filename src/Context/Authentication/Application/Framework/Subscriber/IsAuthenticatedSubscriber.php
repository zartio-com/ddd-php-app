<?php
declare(strict_types=1);

namespace Context\Authentication\Application\Framework\Subscriber;

use Context\Authentication\Application\PublicApi\Attribute\Controller\RequireAuthenticated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class IsAuthenticatedSubscriber implements EventSubscriberInterface
{
    #[\Override] public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => ['onKernelControllerArguments']
        ];
    }

    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $attrs = $event->getAttributes();

        /** @var RequireAuthenticated[]|RequireAuthenticated|object|object[]|null $isUserGrantedAttrs */
        $isAuthenticatedAttrs = $attrs[RequireAuthenticated::class] ?? null;

        if (!$isAuthenticatedAttrs) {
            return;
        }

        if (!is_array($isAuthenticatedAttrs)) {
            $isAuthenticatedAttrs = [$isAuthenticatedAttrs];
        }

        $isAuthenticated = $isAuthenticatedAttrs[0];

        throw new AccessDeniedHttpException();
    }
}