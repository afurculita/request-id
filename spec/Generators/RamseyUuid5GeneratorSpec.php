<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\RamseyUuid5Generator;
use Arki\RequestId\Generators\RequestIdGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin RamseyUuid5Generator
 */
class RamseyUuid5GeneratorSpec extends ObjectBehavior
{
    function let(UuidFactoryInterface $factory)
    {
        $this->beConstructedWith($factory, 'ns', 'name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\RamseyUuid5Generator');
    }

    function it_is_a_request_id_generator()
    {
        $this->shouldImplement(RequestIdGenerator::class);
    }

    function it_generates_a_request_id(UuidFactoryInterface $factory, UuidInterface $uuid)
    {
        $factory->uuid5('ns', 'name')->shouldBeCalled()->willReturn($uuid);
        $uuid->toString()->willReturn('hubabuba');

        $uuid = $this->generate();

        $uuid->shouldBeEqualTo('hubabuba');
    }
}
