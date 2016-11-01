<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Generators;

final class PrefixedGenerator implements RequestIdGenerator
{
    private $prefix;

    private $generator;

    /**
     * @param string             $prefix
     * @param RequestIdGenerator $generator
     */
    public function __construct($prefix, RequestIdGenerator $generator)
    {
        $this->prefix = (string) $prefix;
        $this->generator = $generator;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->prefix.$this->generator->generate();
    }
}
