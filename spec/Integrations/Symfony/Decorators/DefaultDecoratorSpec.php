<?php

namespace spec\Arki\RequestId\Integrations\Symfony\Decorators;

use Arki\RequestId\Integrations\Symfony\Decorators\DefaultDecorator;
use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use Emag\SapBundle\Communication\Request;
use PhpSpec\ObjectBehavior;

/**
 * @mixin DefaultDecorator
 */
class DefaultDecoratorSpec extends ObjectBehavior
{
    function let(RequestIdProvider $idProvider)
    {
        $this->beConstructedWith($idProvider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Integrations\Symfony\Decorators\DefaultDecorator');
    }

    function it_decorates_a_request_if_an_id_can_be_provided(RequestIdProvider $idProvider)
    {
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $idProvider->getRequestId()->willReturn('aaaa');

        $this->decorateRequest($request);

        expect($request->headers->get(RequestId::HEADER_NAME))->toBe('aaaa');
    }
}
