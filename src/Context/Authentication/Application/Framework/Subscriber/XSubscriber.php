<?php
declare(strict_types=1);

namespace Context\Authentication\Application\Framework\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class XSubscriber implements EventSubscriberInterface
{
    #[\Override] public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['']
        ];
    }

    public function onKernelEventRequest(RequestEvent $event): void
    {
        $event->getRequest()->headers->has('Authentication');
    }
}