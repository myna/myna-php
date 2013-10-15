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
        $variant = $client->suggest('single');
        assert(get_class($variant) === 'Myna\Data\Variant');
        $client->reward('single');
    }

    function it_should_allow_multiple_clients_using_same_deployment() {
        $deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';
        $c1 = \Myna\Myna::init($deploymentUuid);
        $c2 = \Myna\Myna::init($deploymentUuid);
        $v1 = $c1->suggest('single');
        $v2 = $c2->suggest('single');
        assert(get_class($v1) === 'Myna\Data\Variant');
        assert(get_class($v2) === 'Myna\Data\Variant');
        $c1->reward('single');
        $c2->reward('single');
    }

}
