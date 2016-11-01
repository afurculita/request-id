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

final class HashGenerator implements RequestIdGenerator
{
    private $generator;

    /**
     * @var string
     */
    private $hashingAlgorithm;

    /**
     * @param RequestIdGenerator $generator
     * @param string             $hashingAlgorithm
     */
    public function __construct(RequestIdGenerator $generator, $hashingAlgorithm = 'md5')
    {
        $this->generator = $generator;
        $this->hashingAlgorithm = $hashingAlgorithm;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return hash($this->hashingAlgorithm, $this->generator->generate());
    }
}
