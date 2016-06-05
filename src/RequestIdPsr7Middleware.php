<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Arki\RequestId;

use Arki\RequestId\Decorators\AddsRequestIdToHttpMessage;
use Arki\RequestId\Decorators\HttpMessageDecorator;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class RequestIdPsr7Middleware
{
    /**
     * @var RequestIdProviderFactory
     */
    private $providerFactory;

    /**
     * @var HttpMessageDecorator
     */
    private $requestDecorator;

    /**
     * @var HttpMessageDecorator
     */
    private $responseDecorator;

    /**
     * @param RequestIdProviderFactory $providerFactory
     * @param HttpMessageDecorator     $requestDecorator
     * @param HttpMessageDecorator     $responseDecorator
     */
    public function __construct(
        RequestIdProviderFactory $providerFactory,
        HttpMessageDecorator $requestDecorator = null,
        HttpMessageDecorator $responseDecorator = null
    ) {
        $this->providerFactory = $providerFactory;
        $this->requestDecorator = $requestDecorator;
        $this->responseDecorator = $responseDecorator;
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable          $next
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException for invalid header values or names
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $provider = $this->providerFactory->create($request);

        if (!$this->requestDecorator) {
            $this->requestDecorator = new AddsRequestIdToHttpMessage($provider);
        }

        if (!$this->responseDecorator) {
            $this->responseDecorator = new AddsRequestIdToHttpMessage($provider);
        }

        $decoratedRequest = $this->requestDecorator->decorate($request);

        return $this->responseDecorator->decorate($next($decoratedRequest, $response));
    }
}
