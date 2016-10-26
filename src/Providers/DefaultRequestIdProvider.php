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
use Arki\RequestId\Policies\AlwaysTrustRequests;
use Arki\RequestId\Policies\TrustRequestPolicy;
use Arki\RequestId\RequestId;
use Psr\Http\Message\RequestInterface;

final class DefaultRequestIdProvider implements RequestIdProvider
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
     * @var TrustRequestPolicy
     */
    private $trustPolicy;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var string
     */
    private $requestHeader;

    /**
     * @param RequestInterface   $request
     * @param RequestIdGenerator $generator
     * @param TrustRequestPolicy $trustPolicy
     * @param string             $requestHeader
     */
    public function __construct(
        RequestInterface $request,
        RequestIdGenerator $generator,
        $requestHeader = RequestId::HEADER_NAME,
        TrustRequestPolicy $trustPolicy = null
    ) {
        $this->request = $request;
        $this->generator = $generator;
        $this->trustPolicy = $trustPolicy ?: new AlwaysTrustRequests();
        $this->requestHeader = $requestHeader;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        if (null !== $this->requestId) {
            return $this->requestId;
        }

        if ($this->canBeTakenFromRequest()) {
            $this->requestId = $this->request->getHeaderLine($this->requestHeader);
        }

        if (null === $this->requestId || '' === $this->requestId) {
            $this->requestId = $this->generator->generate();
        }

        return $this->requestId;
    }

    /**
     * @return bool
     */
    private function canBeTakenFromRequest()
    {
        return true === $this->trustPolicy->shouldTrust($this->request)
               && $this->request->hasHeader($this->requestHeader);
    }
}
