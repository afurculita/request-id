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
use Arki\RequestId\Policies\TrustRequestPolicy;
use Arki\RequestId\RequestId;
use Psr\Http\Message\RequestInterface;

final class DefaultRequestIdProviderFactory implements RequestIdProviderFactory
{
    /**
     * @var RequestIdGenerator
     */
    private $generator;

    /**
     * @var TrustRequestPolicy
     */
    private $trustPolicy;

    /**
     * @var string
     */
    private $headerName;

    /**
     * @param RequestIdGenerator $generator
     * @param TrustRequestPolicy $trustRequestPolicy
     * @param string             $headerName
     */
    public function __construct(
        RequestIdGenerator $generator,
        $headerName = RequestId::HEADER_NAME,
        TrustRequestPolicy $trustRequestPolicy = null
    ) {
        $this->generator = $generator;
        $this->trustPolicy = $trustRequestPolicy;
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
            $this->trustPolicy
        );
    }
}
