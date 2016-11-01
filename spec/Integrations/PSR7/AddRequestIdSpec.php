<?php

namespace spec\Arki\RequestId\Integrations\PSR7;

use Arki\RequestId\Integrations\PSR7\AddRequestId;
use Arki\RequestId\Integrations\PSR7\Decorators\HttpMessageDecorator;
use Arki\RequestId\Integrations\PSR7\Decorators\ReturnsMessageAsIs;
use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\Providers\RequestIdProviderFactory;
use Arki\RequestId\RequestId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

/**
 * @mixin AddRequestId
 */
class AddRequestIdSpec extends ObjectBehavior
{
    function let(
        RequestIdProviderFactory $providerFactory,
        HttpMessageDecorator $requestDecorator,
        HttpMessageDecorator $responseDecorator
    ) {
        $this->beConstructedWith($providerFactory, $requestDecorator, $responseDecorator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddRequestId::class);
    }

    function it_can_add_request_id_to_request_and_response(
        RequestIdProviderFactory $providerFactory,
        RequestIdProvider $idProvider
    ) {
        $this->beConstructedWith($providerFactory);

        $providerFactory->create(Argument::any())->shouldBeCalled()->willReturn($idProvider);
        $idProvider->getRequestId()->shouldBeCalled()->willReturn('hubabuba');

        $request = new ServerRequest();
        $response = new Response();

        $outFunction = function ($request, $response) {
            return $response;
        };

        $result = call_user_func($this, $request, $response, $outFunction);

        $result->shouldBeAnInstanceOf(ResponseInterface::class);
        $result->getHeaderLine(RequestId::HEADER_NAME)->shouldBeEqualTo('hubabuba');
        $result->shouldNotBeLike($response);
    }

    function it_can_not_add_request_id_to_request_and_response(
        RequestIdProviderFactory $providerFactory,
        RequestIdProvider $idProvider
    ) {
        $this->beConstructedWith($providerFactory, new ReturnsMessageAsIs(), new ReturnsMessageAsIs());

        $providerFactory->create(Argument::any())->shouldBeCalled()->willReturn($idProvider);
        $idProvider->getRequestId()->shouldNotBeCalled();

        $request = new ServerRequest();
        $response = new Response();

        $outFunction = function ($request, $response) {
            return $response;
        };

        $result = call_user_func($this, $request, $response, $outFunction);

        $result->shouldBeAnInstanceOf(ResponseInterface::class);
        $result->hasHeader(RequestId::HEADER_NAME)->shouldBe(false);
        $result->shouldBeLike($response);
    }
}
