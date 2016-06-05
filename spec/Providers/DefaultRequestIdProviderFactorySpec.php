<?php

namespace spec\Arki\RequestId\Providers;

use Arki\RequestId\Generators\RequestIdGenerator;
use Arki\RequestId\Policies\OverrideRequestIdPolicy;
use Arki\RequestId\Providers\DefaultRequestIdProviderFactory;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Arki\RequestId\RequestId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin DefaultRequestIdProviderFactory
 */
class DefaultRequestIdProviderFactorySpec extends ObjectBehavior
{
    function let(RequestIdGenerator $generator, OverrideRequestIdPolicy $overrideRequestIdPolicy)
    {
        $this->beConstructedWith($generator, RequestId::HEADER_NAME, $overrideRequestIdPolicy);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Providers\DefaultRequestIdProviderFactory');
    }

    function it_is_a_request_id_provider_factory()
    {
        $this->shouldImplement(RequestIdProviderFactory::class);
    }
}
