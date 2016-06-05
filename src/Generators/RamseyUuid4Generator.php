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

use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuid4Generator implements RequestIdGenerator
{
    private $factory;

    public function __construct(UuidFactoryInterface $factory = null)
    {
        $this->factory = $factory ?: new UuidFactory();
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->factory->uuid4()->toString();
    }
}
