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

use Arki\RequestId\Providers\RequestAware;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Arki\RequestId\RequestId;
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
     * @var RequestIdProviderFactory
     */
    private $providerFactory;
    /**
     * @var string
     */
    private $requestHeader;

    /**
     * @param RequestIdProviderFactory $providerFactory
     * @param string                   $requestHeader
     */
    public function __construct(RequestIdProviderFactory $providerFactory, $requestHeader = RequestId::HEADER_NAME)
    {
        $this->providerFactory = $providerFactory;
        $this->requestHeader = $requestHeader;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onRequest(GetResponseEvent $event)
    {
        if (!$event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        if ($this->providerFactory instanceof RequestAware) {
            $this->providerFactory->setRequest($event->getRequest());
        }

        $provider = $this->providerFactory->create();

        if (null === $provider->getRequestId()) {
            return;
        }

        $event->getRequest()->headers->set($this->requestHeader, $provider->getRequestId());
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => ['onRequest', 200]];
    }
}
