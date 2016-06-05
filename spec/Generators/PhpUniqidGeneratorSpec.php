<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\PhpUniqidGenerator;
use Arki\RequestId\Generators\RequestIdGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin PhpUniqidGenerator
 */
class PhpUniqidGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\PhpUniqidGenerator');
    }

    function it_is_a_request_id_generator()
    {
        $this->shouldImplement(RequestIdGenerator::class);
    }

    function it_generates_a_request_id()
    {
        $requestId = $this->generate();

        $requestId->shouldBeString();
    }
}
