<?php

namespace spec\Arki\RequestId\Policies;

use Arki\RequestId\Policies\AlwaysTrustRequests;
use Arki\RequestId\Policies\TrustRequestPolicy;
use PhpSpec\ObjectBehavior;

/**
 * @mixin AlwaysTrustRequests
 */
class AlwaysTrustRequestsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AlwaysTrustRequests::class);
    }

    function it_is_a_trust_request_policy()
    {
        $this->shouldImplement(TrustRequestPolicy::class);
    }
}
