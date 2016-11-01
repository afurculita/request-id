<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\Uuid1Generator;
use Arki\RequestId\Generators\RequestIdGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin Uuid1Generator
 */
class Uuid1GeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\Uuid1Generator');
    }

    function it_is_a_request_id_generator()
    {
        $this->shouldImplement(RequestIdGenerator::class);
    }

    function it_generates_a_request_id()
    {
        $this->generate()->shouldBeString();
    }
}
