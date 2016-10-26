<?php

namespace spec\Arki\RequestId\Policies;

use Arki\RequestId\Policies\NeverTrustRequests;
use Arki\RequestId\Policies\TrustRequestPolicy;
use PhpSpec\ObjectBehavior;

/**
 * @mixin NeverTrustRequests
 */
class NeverTrustRequestsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NeverTrustRequests::class);
    }

    function it_is_a_trust_request_policy()
    {
        $this->shouldImplement(TrustRequestPolicy::class);
    }
}
