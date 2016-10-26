<?php

namespace spec\Arki\RequestId\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Policies\TrustRequestPolicy;
use Arki\RequestId\Providers\DefaultRequestIdProvider;
use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;

/**
 * @mixin DefaultRequestIdProvider
 */
class DefaultRequestIdProviderSpec extends ObjectBehavior
{
    function let(
        RequestInterface $request,
        RequestIdGenerator $generator,
        TrustRequestPolicy $trustRequestPolicy
    ) {
        $this->beConstructedWith($request, $generator, RequestId::HEADER_NAME, $trustRequestPolicy);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Providers\DefaultRequestIdProvider');
    }

    function it_is_a_request_id_provider()
    {
        $this->shouldImplement(RequestIdProvider::class);
    }

    function it_generates_a_request_id_if_there_is_no_header(
        RequestIdGenerator $generator,
        RequestInterface $request,
        TrustRequestPolicy $trustRequestPolicy
    ) {
        $trustRequestPolicy->shouldTrust($request)->shouldBeCalled()->willReturn(true);
        $request->hasHeader(RequestId::HEADER_NAME)->shouldBeCalled()->willReturn(false);
        $generator->generate()->shouldBeCalled()->willReturn('hubabuba');

        $requestId = $this->getRequestId();

        $requestId->shouldBeEqualTo('hubabuba');
    }

    function it_generates_a_request_id_if_it_is_dissalowed_to_override_the_header_request(
        RequestIdGenerator $generator,
        RequestInterface $request,
        TrustRequestPolicy $trustRequestPolicy
    ) {
        $trustRequestPolicy->shouldTrust($request)->shouldBeCalled()->willReturn(false);
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

    function it_does_not_generate_a_request_id_if_the_header_exists(
        RequestIdGenerator $generator,
        RequestInterface $request,
        TrustRequestPolicy $trustRequestPolicy
    ) {
        $trustRequestPolicy->shouldTrust($request)->shouldBeCalled()->willReturn(true);
        $request->hasHeader(RequestId::HEADER_NAME)->shouldBeCalled()->willReturn(true);
        $request->getHeaderLine(RequestId::HEADER_NAME)->shouldBeCalled()->willReturn('hubabuba');

        $generator->generate()->shouldNotBeCalled();

        $requestId = $this->getRequestId();

        $requestId->shouldBeEqualTo('hubabuba');
    }

    function it_generates_a_request_id_if_the_header_exists_but_is_empty(
        RequestIdGenerator $generator,
        RequestInterface $request,
        TrustRequestPolicy $trustRequestPolicy
    ) {
        $trustRequestPolicy->shouldTrust($request)->shouldBeCalled()->willReturn(true);
        $request->hasHeader(RequestId::HEADER_NAME)->shouldBeCalled()->willReturn(true);
        $request->getHeaderLine(RequestId::HEADER_NAME)->shouldBeCalled()->willReturn('');
        $generator->generate()->shouldBeCalled()->willReturn('hubabuba');
        
        $requestId = $this->getRequestId();
        $requestId->shouldBeEqualTo('hubabuba');

        $request->getHeaderLine(RequestId::HEADER_NAME)->shouldBeCalled()->willReturn(null);
        $requestId = $this->getRequestId();
        $requestId->shouldBeEqualTo('hubabuba');
    }
}
