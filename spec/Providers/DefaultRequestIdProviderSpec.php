<?php

namespace spec\Arki\RequestId\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Providers\DefaultRequestIdProvider;
use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;

/**
 * @mixin DefaultRequestIdProvider
 */
class DefaultRequestIdProviderSpec extends ObjectBehavior
{
    function let(RequestIdGenerator $generator)
    {
        $this->beConstructedWith($generator, RequestId::HEADER_NAME);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Providers\DefaultRequestIdProvider');
    }

    function it_is_a_request_id_provider()
    {
        $this->shouldImplement(RequestIdProvider::class);
    }

    function it_generates_a_request_id_if_it_is_dissalowed_to_override_the_header_request(
        RequestIdGenerator $generator
    ) {
        $generator->generate()->shouldBeCalled()->willReturn('hubabuba');

        $requestId = $this->getRequestId();

        $requestId->shouldBeEqualTo('hubabuba');
    }

    function it_caches_the_generated_request_id(RequestIdGenerator $generator)
    {
        $generator->generate()->shouldBeCalled()->willReturn('hubabuba');

        $requestId = $this->getRequestId();

        $requestId->shouldBeEqualTo('hubabuba');

        $generator->generate()->willReturn('havana');
        $requestIdAfterSecondCall = $this->getRequestId();

        $requestIdAfterSecondCall->shouldBeEqualTo('hubabuba');
    }
}
