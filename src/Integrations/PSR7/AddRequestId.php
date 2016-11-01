<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\PSR7;

use Arki\RequestId\Integrations\PSR7\Decorators\AddsRequestIdToHttpMessage;
use Arki\RequestId\Integrations\PSR7\Decorators\HttpMessageDecorator;
use Arki\RequestId\Providers\RequestAware;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * PSR7 Middleware that adds an id to requests and responses.
 */
final class AddRequestId
{
    /**
     * @var HttpMessageDecorator
     */
    private $requestDecorator;

    /**
     * @var HttpMessageDecorator
     */
    private $responseDecorator;
    /**
     * @var RequestIdProviderFactory
     */
    private $providerFactory;

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
        $this->requestDecorator = $requestDecorator;
        $this->responseDecorator = $responseDecorator;
        $this->providerFactory = $providerFactory;
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable          $next
     *
     * @return ResponseInterface|MessageInterface
     *
     * @throws \InvalidArgumentException for invalid header values or names
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        if ($this->providerFactory instanceof RequestAware) {
            $this->providerFactory->setRequest($request);
        }

        $provider = $this->providerFactory->create();

        if (!$this->requestDecorator) {
            $this->requestDecorator = new AddsRequestIdToHttpMessage($provider);
        }

        if (!$this->responseDecorator) {
            $this->responseDecorator = new AddsRequestIdToHttpMessage($provider);
        }

        return $this->responseDecorator->decorate($next($this->requestDecorator->decorate($request), $response));
    }
}
