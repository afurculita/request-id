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

use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use Psr\Http\Message\RequestInterface;

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
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface  $request
     * @param string            $headerName
     * @param RequestIdProvider $fallback
     */
    public function __construct(
        RequestInterface $request,
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
        if ($this->request->hasHeader($this->headerName)) {
            return $this->request->getHeader($this->headerName);
        }

        return $this->fallback->getRequestId();
    }
}
