<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony\Providers;

use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use Symfony\Component\HttpFoundation\Request;

final class ExtractsRequestIdFromHeader implements RequestIdProvider
{
    /**
     * @var string
     */
    private $headerName;
    /**
     * @var RequestIdProvider
     */
    private $fallback;
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request           $request
     * @param string            $headerName
     * @param RequestIdProvider $fallback
     */
    public function __construct(
        Request $request,
        RequestIdProvider $fallback,
        $headerName = RequestId::HEADER_NAME
    ) {
        $this->headerName = $headerName;
        $this->fallback = $fallback;
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        if ($this->request->headers->has($this->headerName)) {
            return $this->request->headers->get($this->headerName);
        }

        return $this->fallback->getRequestId();
    }
}
