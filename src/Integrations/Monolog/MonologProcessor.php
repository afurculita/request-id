<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Monolog;

use Arki\RequestId\Providers\RequestIdProvider;

final class MonologProcessor
{
    private $requestIdProvider;

    /**
     * @var string
     */
    private $key;

    /**
     * @param RequestIdProvider $requestIdProvider
     * @param string            $key
     */
    public function __construct(RequestIdProvider $requestIdProvider, $key = 'request_id')
    {
        $this->requestIdProvider = $requestIdProvider;
        $this->key = $key;
    }

    public function __invoke(array $record)
    {
        $record['extra'][$this->key] = $this->requestIdProvider->getRequestId();

        return $record;
    }
}
