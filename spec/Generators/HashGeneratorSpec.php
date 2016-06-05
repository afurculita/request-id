<?php

namespace spec\Arki\RequestId\Generators;

use Arki\RequestId\Generators\HashGenerator;
use Arki\RequestId\Generators\RequestIdGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin HashGenerator
 */
class HashGeneratorSpec extends ObjectBehavior
{
    function let(RequestIdGenerator $generator)
    {
        $this->beConstructedWith($generator, 'md5');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Generators\HashGenerator');
    }

    function it_is_a_request_id_generator()
    {
        $this->shouldImplement(RequestIdGenerator::class);
    }

    function it_hashes_a_generated_request_id(RequestIdGenerator $generator)
    {
        $generator->generate()->shouldBeCalled()->willReturn('hubabuba');

        $hash = $this->generate();

        $hash->shouldBeEqualTo('fa9d0a3a797979cdaa41a503d91a5671');
    }
}
