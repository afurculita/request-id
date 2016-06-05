<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\PrefixedGenerator;
use Arki\RequestId\Generators\RequestIdGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin PrefixedGenerator
 */
class PrefixedGeneratorSpec extends ObjectBehavior
{
    function let(RequestIdGenerator $generator)
    {
        $this->beConstructedWith('huba', $generator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\PrefixedGenerator');
    }

    function it_is_a_request_id_generator()
    {
        $this->shouldImplement(RequestIdGenerator::class);
    }

    function it_adds_a_prefix_to_a_generated_request_id(RequestIdGenerator $generator)
    {
        $generator->generate()->shouldBeCalled()->willReturn('buba');

        $prefixedRequestId = $this->generate();

        $prefixedRequestId->shouldBeEqualTo('hubabuba');
    }
}
