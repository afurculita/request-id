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

use Arki\RequestId\Integrations\Symfony\Decorators\ResponseDecorator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Adds request ID on responses.
 */
final class AddsRequestIdOnResponse implements EventSubscriberInterface
{
    /**
     * @var ResponseDecorator
     */
    private $decorator;

    /**
     * @param ResponseDecorator $decorator
     */
    public function __construct(ResponseDecorator $decorator)
    {
        $this->decorator = $decorator;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onResponse(FilterResponseEvent $event)
    {
        if (!$event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        $this->decorator->decorateResponse($event->getResponse());
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::RESPONSE => ['onResponse', -200]];
    }
}
