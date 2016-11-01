<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Twig;

use Arki\RequestId\Providers\RequestIdProvider;

/**
 * Add the request ID to twig as a function.
 */
final class RequestIdExtension extends \Twig_Extension
{
    /**
     * @var RequestIdProvider
     */
    private $provider;
    /**
     * @var string
     */
    private $functionName;

    /**
     * @param RequestIdProvider $provider
     * @param string            $functionName
     */
    public function __construct(RequestIdProvider $provider, $functionName = 'request_id')
    {
        $this->provider = $provider;
        $this->functionName = $functionName;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction($this->functionName, [$this->provider, 'getRequestId']),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return __CLASS__;
    }
}
