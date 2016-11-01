<?php

/*
 * This file is part of the Arki\RequestId library.
 *
 * (c) Alexandru Furculita <alex@furculita.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Arki\RequestId\Integrations\PSR7\Decorators;

use Psr\Http\Message\MessageInterface;

final class ReturnsMessageAsIs implements HttpMessageDecorator
{
    /**
     * Returns message as is. No decoration is done.
     *
     * @param MessageInterface $message
     *
     * @return MessageInterface
     */
    public function decorate(MessageInterface $message)
    {
        return $message;
    }
}
