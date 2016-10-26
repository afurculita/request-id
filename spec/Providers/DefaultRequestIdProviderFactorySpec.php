<?php

namespace spec\Arki\RequestId\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Policies\TrustRequestPolicy;
use Arki\RequestId\Providers\DefaultRequestIdProvider;
use Arki\RequestId\Providers\DefaultRequestIdProviderFactory;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Arki\RequestId\RequestId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;

/**
 * @mixin DefaultRequestIdProviderFactory
 */
class DefaultRequestIdProviderFactorySpec extends ObjectBehavior
{
    function let(RequestIdGenerator $generator, TrustRequestPolicy $trustRequestPolicy)
    {
        $this->beConstructedWith($generator, RequestId::HEADER_NAME, $trustRequestPolicy);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Providers\DefaultRequestIdProviderFactory');
    }

    function it_is_a_request_id_provider_factory()
    {
        $this->shouldImplement(RequestIdProviderFactory::class);
    }

    function it_creates_request_id_providers(RequestInterface $request)
    {
        $provider = $this->create($request);

        $provider->shouldHaveType(DefaultRequestIdProvider::class);
    }
}
