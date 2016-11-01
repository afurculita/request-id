<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\PSR7\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Providers\DefaultRequestIdProvider;
use Arki\RequestId\Providers\RequestAware;
use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Psr\Http\Message\RequestInterface;

final class HeaderBasedProviderFactory implements RequestIdProviderFactory, RequestAware
{
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var RequestIdGenerator
     */
    private $generator;

    /**
     * @param RequestIdGenerator $generator
     */
    public function __construct(RequestIdGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return RequestIdProvider
     */
    public function create()
    {
        return new ExtractsRequestIdFromHeader($this->request, new DefaultRequestIdProvider($this->generator));
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest($request)
    {
        if (!$request instanceof RequestInterface) {
            throw new \InvalidArgumentException('Invalid argument received. Expected: '.RequestInterface::class);
        }

        $this->request = $request;
    }
}
