<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Arki\RequestId\Generators;

final class PhpUniqidGenerator implements RequestIdGenerator
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var bool
     */
    private $moreEntropy;

    /**
     * @param string $prefix
     * @param bool   $moreEntropy
     *
     * @link http://php.net/manual/en/function.uniqid.php
     */
    public function __construct($prefix = '', $moreEntropy = false)
    {
        $this->prefix = (string) $prefix;
        $this->moreEntropy = (bool) $moreEntropy;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return uniqid($this->prefix, $this->moreEntropy);
    }
}
