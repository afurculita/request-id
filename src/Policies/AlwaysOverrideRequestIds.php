<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Arki\RequestId\Policies;

use Psr\Http\Message\RequestInterface;

final class AlwaysOverrideRequestIds implements OverrideRequestIdPolicy
{
    public function isAllowedToOverride(RequestInterface $request)
    {
        return true;
    }
}