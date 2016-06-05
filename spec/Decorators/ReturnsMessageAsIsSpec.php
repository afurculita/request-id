<?php

namespace spec\Arki\RequestId\Decorators;

use Arki\RequestId\Decorators\HttpMessageDecorator;
use Arki\RequestId\Decorators\ReturnsMessageAsIs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin ReturnsMessageAsIs
 */
class ReturnsMessageAsIsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Decorators\ReturnsMessageAsIs');
    }

    function it_is_a_http_message_decorator()
    {
        $this->shouldImplement(HttpMessageDecorator::class);
    }
}
