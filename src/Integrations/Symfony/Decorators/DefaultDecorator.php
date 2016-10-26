<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony\Decorators;

use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Arki\RequestId\RequestId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class DefaultDecorator implements RequestDecorator, ResponseDecorator
{
    /**
     * @var RequestIdProvider
     */
    private $providerFactory;
    /**
     * @var string
     */
    private $requestHeader;
    /**
     * @var string
     */
    private $responseHeader;

    /**
     * @param RequestIdProviderFactory $providerFactory
     * @param string                   $requestHeader
     * @param string                   $responseHeader
     */
    public function __construct(
        RequestIdProviderFactory $providerFactory,
        $requestHeader = RequestId::HEADER_NAME,
        $responseHeader = RequestId::HEADER_NAME
    ) {
        $this->providerFactory = $providerFactory;
        $this->requestHeader = $requestHeader;
        $this->responseHeader = $responseHeader;
    }

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function decorateRequest(Request $request)
    {
        $provider = $this->providerFactory->create($request);

        if (null === $provider->getRequestId()) {
            return $request;
        }

        $request->headers->set($this->requestHeader, $provider->getRequestId());
    }

    /**
     * @param Response $response
     *
     * @return Response
     */
    public function decorateResponse(Response $response)
    {
        if (null === $this->providerFactory->getRequestId()) {
            return $response;
        }

        $response->headers->set($this->responseHeader, $this->providerFactory->getRequestId());
    }
}
