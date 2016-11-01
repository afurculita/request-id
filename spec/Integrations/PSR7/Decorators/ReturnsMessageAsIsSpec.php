<?php

namespace spec\Arki\RequestId\Integrations\PSR7\Decorators;

use Arki\RequestId\Integrations\PSR7\Decorators\HttpMessageDecorator;
use Arki\RequestId\Integrations\PSR7\Decorators\ReturnsMessageAsIs;
use PhpSpec\ObjectBehavior;

/**
 * @mixin ReturnsMessageAsIs
 */
class ReturnsMessageAsIsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ReturnsMessageAsIs::class);
    }

    function it_is_a_http_message_decorator()
    {
        $this->shouldImplement(HttpMessageDecorator::class);
    }
}
