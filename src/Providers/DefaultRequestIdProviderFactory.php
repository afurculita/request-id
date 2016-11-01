<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;

final class DefaultRequestIdProviderFactory implements RequestIdProviderFactory
{
    /**
     * @var RequestIdGenerator
     */
    private $generator;

    /**
     * @param RequestIdGenerator $generator
     */
    public function __construct(RequestIdGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return DefaultRequestIdProvider
     */
    public function create()
    {
        return new DefaultRequestIdProvider($this->generator);
    }
}
