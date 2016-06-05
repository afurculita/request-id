<?php

namespace spec\Arki\RequestId\Policies;

use Arki\RequestId\Policies\NeverOverrideRequestIds;
use Arki\RequestId\Policies\OverrideRequestIdPolicy;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin NeverOverrideRequestIds
 */
class NeverOverrideRequestIdsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Arki\RequestId\Policies\NeverOverrideRequestIds');
    }

    function it_is_an_override_request_id_policy()
    {
        $this->shouldImplement(OverrideRequestIdPolicy::class);
    }
}
