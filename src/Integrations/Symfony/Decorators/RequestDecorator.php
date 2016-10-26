<?php

/*
 * This file is part of the Arkitekto\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\Symfony\Decorators;

use Symfony\Component\HttpFoundation\Request;

interface RequestDecorator
{
    /**
     * @param Request $request
     *
     * @return Request
     */
    public function decorateRequest(Request $request);
}
