<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ForgetfulSessionSpec extends ObjectBehavior
{

    function it_should_be_a_session() {
        $this->shouldBeAnInstanceOf('Myna\Session');
    }

    function it_should_forget_all_data() {
        $this->get('socks')->shouldBe(false);
        $this->put('socks', 'catdogbird');
        $this->get('socks')->shouldBe(false);
    }

}
