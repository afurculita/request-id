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

use Ramsey\Uuid\Uuid;

final class RamseyUuid4StaticGenerator implements RequestIdGenerator
{
    /**
     * @return string
     */
    public function generate()
    {
        return Uuid::uuid4()->toString();
    }
}
