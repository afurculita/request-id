<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
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

    public function __construct(RequestIdProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('request_id', [$this->provider, 'getRequestId']),
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
