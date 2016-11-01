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

use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidFactoryInterface;

final class Uuid1Generator implements RequestIdGenerator
{
    private $node;

    private $clockSeq;

    private $factory;

    /**
     * @param UuidFactoryInterface $factory
     * @param int|string           $node
     * @param int                  $clockSeq
     */
    public function __construct(UuidFactoryInterface $factory = null, $node = null, $clockSeq = null)
    {
        $this->factory = $factory ?: new UuidFactory();
        $this->node = $node;
        $this->clockSeq = $clockSeq;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->factory->uuid1($this->node, $this->clockSeq)->toString();
    }
}
