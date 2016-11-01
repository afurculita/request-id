<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Generators\Uuid5Generator;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin Uuid5Generator
 */
class Uuid5GeneratorSpec extends ObjectBehavior
{
    function let(UuidFactoryInterface $factory)
    {
        $this->beConstructedWith('ns', 'name', $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\Uuid5Generator');
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
