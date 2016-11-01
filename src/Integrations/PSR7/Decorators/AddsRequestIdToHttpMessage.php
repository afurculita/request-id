<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\PSR7\Decorators;

use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use Psr\Http\Message\MessageInterface;

final class AddsRequestIdToHttpMessage implements HttpMessageDecorator
{
    private $idProvider;

    private $headerName;

    /**
     * @param RequestIdProvider $idProvider
     * @param string            $headerName
     */
    public function __construct(RequestIdProvider $idProvider, $headerName = RequestId::HEADER_NAME)
    {
        $this->idProvider = $idProvider;
        $this->headerName = $headerName;
    }

    /**
     * Adds request id to request/response and returns new instance.
     *
     * @param MessageInterface $message
     *
     * @return MessageInterface
     *
     * @throws \InvalidArgumentException
     */
    public function decorate(MessageInterface $message)
    {
        return $message->withHeader($this->headerName, $this->idProvider->getRequestId());
    }
}
