<?php

namespace spec\Arki\RequestId\Integrations\Twig;

use Arki\RequestId\Integrations\Twig\RequestIdExtension;
use Arki\RequestId\Providers\RequestIdProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin RequestIdExtension
 */
class RequestIdExtensionSpec extends ObjectBehavior
{
    function let(RequestIdProvider $provider)
    {
        $this->beConstructedWith($provider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Integrations\Twig\RequestIdExtension');
    }

    function it_is_a_twig_extension()
    {
        $this->shouldImplement(\Twig_Extension::class);
    }
}
