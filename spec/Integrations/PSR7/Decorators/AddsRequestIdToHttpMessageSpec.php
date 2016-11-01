<?php

namespace spec\Arki\RequestId\Integrations\PSR7\Decorators;

use Arki\RequestId\Integrations\PSR7\Decorators\AddsRequestIdToHttpMessage;
use Arki\RequestId\Integrations\PSR7\Decorators\HttpMessageDecorator;
use Arki\RequestId\Providers\RequestIdProvider;
use Arki\RequestId\RequestId;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\MessageInterface;

/**
 * @mixin AddsRequestIdToHttpMessage
 */
class AddsRequestIdToHttpMessageSpec extends ObjectBehavior
{
    function let(RequestIdProvider $requestIdProvider)
    {
        $this->beConstructedWith($requestIdProvider, RequestId::HEADER_NAME);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddsRequestIdToHttpMessage::class);
    }

    function it_is_a_http_message_decorator()
    {
        $this->shouldImplement(HttpMessageDecorator::class);
    }

    function it_decorates_http_messages_with_request_id(
        RequestIdProvider $requestIdProvider,
        MessageInterface $message,
        MessageInterface $returnedMessage
    ) {
        $requestIdProvider->getRequestId()
            ->shouldBeCalled()
            ->willReturn('chiuaua');
        $message->withHeader(RequestId::HEADER_NAME, 'chiuaua')
            ->shouldBeCalled()
            ->willReturn($returnedMessage);

        $decoratedMessage = $this->decorate($message);

        $decoratedMessage->shouldBeAnInstanceOf(MessageInterface::class);
        $decoratedMessage->shouldNotBeEqualTo($message);
    }
}
