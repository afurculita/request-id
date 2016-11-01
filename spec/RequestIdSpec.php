<?php

namespace spec\Arki\RequestId;

use PhpSpec\ObjectBehavior;

class RequestIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\RequestId');
    }
}
