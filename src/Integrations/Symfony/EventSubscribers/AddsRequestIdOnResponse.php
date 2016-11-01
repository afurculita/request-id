<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony\EventSubscribers;

use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
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
     * @var RequestIdProvider
     */
    private $idProvider;
    /**
     * @var string
     */
    private $responseHeader;

    /**
     * @param RequestIdProvider $idProvider
     * @param string            $responseHeader
     */
    public function __construct(RequestIdProvider $idProvider, $responseHeader = RequestId::HEADER_NAME)
    {
        $this->idProvider = $idProvider;
        $this->responseHeader = $responseHeader;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onResponse(FilterResponseEvent $event)
    {
        if (!$event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        if (null === $this->idProvider->getRequestId()) {
            return;
        }

        $event->getResponse()->headers->set($this->responseHeader, $this->idProvider->getRequestId());
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::RESPONSE => ['onResponse', -200]];
    }
}
