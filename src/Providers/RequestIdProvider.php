<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Arki\RequestId\Providers;

interface RequestIdProvider
{
    /**
     * @return string|null
     */
    public function getRequestId();
}