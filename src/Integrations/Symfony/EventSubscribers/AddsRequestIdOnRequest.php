<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony\EventSubscribers;

use Arki\RequestId\Integrations\Symfony\Decorators\RequestDecorator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Adds request ID on requests.
 */
final class AddsRequestIdOnRequest implements EventSubscriberInterface
{
    /**
     * @var RequestDecorator
     */
    private $decorator;

    /**
     * @param RequestDecorator $decorator
     */
    public function __construct(RequestDecorator $decorator)
    {
        $this->decorator = $decorator;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onRequest(GetResponseEvent $event)
    {
        if (!$event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        $this->decorator->decorateRequest($event->getRequest());
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => ['onRequest', 200]];
    }
}
