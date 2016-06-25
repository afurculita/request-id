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
use Arki\RequestId\Policies\AlwaysOverrideRequestIds;
use Arki\RequestId\Policies\OverrideRequestIdPolicy;
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
     * @var OverrideRequestIdPolicy
     */
    private $overridePolicy;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var string
     */
    private $requestHeader;

    /**
     * @param RequestInterface        $request
     * @param RequestIdGenerator      $generator
     * @param OverrideRequestIdPolicy $overridePolicy
     * @param string                  $requestHeader
     */
    public function __construct(
        RequestInterface $request,
        RequestIdGenerator $generator,
        $requestHeader = RequestId::HEADER_NAME,
        OverrideRequestIdPolicy $overridePolicy = null
    ) {
        $this->request = $request;
        $this->generator = $generator;
        $this->overridePolicy = $overridePolicy ?: new AlwaysOverrideRequestIds();
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
        return true === $this->overridePolicy->isAllowedToOverride($this->request)
               && $this->request->hasHeader($this->requestHeader);
    }
}
