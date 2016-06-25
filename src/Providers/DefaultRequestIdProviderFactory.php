<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Policies\OverrideRequestIdPolicy;
use Arki\RequestId\RequestId;
use Psr\Http\Message\RequestInterface;

final class DefaultRequestIdProviderFactory implements RequestIdProviderFactory
{
    /**
     * @var RequestIdGenerator
     */
    private $generator;

    /**
     * @var OverrideRequestIdPolicy
     */
    private $overrideRequestIdPolicy;

    /**
     * @var string
     */
    private $headerName;

    /**
     * @param RequestIdGenerator      $generator
     * @param OverrideRequestIdPolicy $overrideRequestIdPolicy
     * @param string                  $headerName
     */
    public function __construct(
        RequestIdGenerator $generator,
        $headerName = RequestId::HEADER_NAME,
        OverrideRequestIdPolicy $overrideRequestIdPolicy = null
    ) {
        $this->generator = $generator;
        $this->overrideRequestIdPolicy = $overrideRequestIdPolicy;
        $this->headerName = $headerName;
    }

    /**
     * @param RequestInterface $request
     *
     * @return DefaultRequestIdProvider
     */
    public function create(RequestInterface $request)
    {
        return new DefaultRequestIdProvider(
            $request,
            $this->generator,
            $this->headerName,
            $this->overrideRequestIdPolicy
        );
    }
}
