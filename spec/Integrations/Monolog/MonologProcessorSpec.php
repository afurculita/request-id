<?php

namespace spec\Arki\RequestId\Integrations\Monolog;

use Arki\RequestId\Integrations\Monolog\MonologProcessor;
use Arki\RequestId\Providers\RequestIdProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin MonologProcessor
 */
class MonologProcessorSpec extends ObjectBehavior
{
    public function let(RequestIdProvider $requestIdProvider)
    {
        $this->beConstructedWith($requestIdProvider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Integrations\Monolog\MonologProcessor');
    }

    function it_adds_request_id_to_log_record(RequestIdProvider $requestIdProvider)
    {
        $requestIdProvider->getRequestId()->shouldBeCalled()->willReturn('foo');

        $record = ['extra' => []];

        $newRecord = call_user_func($this->getWrappedObject(), $record);

        expect($newRecord['extra'])->toHaveKey('request_id');
        expect($newRecord['extra']['request_id'])->toReturn('foo');
    }
}
