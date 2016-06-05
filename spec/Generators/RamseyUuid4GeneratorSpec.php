<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\RamseyUuid4Generator;
use Arki\RequestId\Generators\RequestIdGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin RamseyUuid4Generator
 */
class RamseyUuid4GeneratorSpec extends ObjectBehavior
{
    function let(UuidFactoryInterface $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\RamseyUuid4Generator');
    }

    function it_is_a_request_id_generator()
    {
        $this->shouldImplement(RequestIdGenerator::class);
    }

    function it_generates_a_request_id(UuidFactoryInterface $factory, UuidInterface $uuid)
    {
        $factory->uuid4()->shouldBeCalled()->willReturn($uuid);
        $uuid->toString()->willReturn('hubabuba');

        $uuid = $this->generate();

        $uuid->shouldBeEqualTo('hubabuba');
    }
}
