<?php

namespace spec\Arki\RequestId\Policies;

use Arki\RequestId\Policies\AlwaysOverrideRequestIds;
use Arki\RequestId\Policies\OverrideRequestIdPolicy;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin AlwaysOverrideRequestIds
 */
class AlwaysOverrideRequestIdsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Policies\AlwaysOverrideRequestIds');
    }

    function it_is_an_override_request_id_policy()
    {
        $this->shouldImplement(OverrideRequestIdPolicy::class);
    }
}
