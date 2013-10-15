<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MynaSpec extends ObjectBehavior
{
    function it_is_initializable() {
        $this->shouldHaveType('Myna\Myna');
    }

    function it_should_raise_exception_on_error() {
        try {
            \Myna\Myna::error("Right here", "Waste matter on fan collision", "data");
        } catch (\Exception $e) {
            // It worked!
            return;
        }
        // If we get here, we failed :-(
        throw new Exception("Myna::error didn't raise exception.");
    }

    function it_should_initialize_a_client_ftw() {
        $deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';
        $client = \Myna\Myna::init($deploymentUuid);
        $client->suggest('single');
        $client->reward('single');
    }

    function it_should_allow_multiple_clients_using_same_deployment() {
        $deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';
        $c1 = \Myna\Myna::init($deploymentUuid);
        $c2 = \Myna\Myna::init($deploymentUuid);
        $c1->suggest('single');
        $c2->suggest('single');
        $c1->reward('single');
        $c2->reward('single');
    }

}
