<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CookieSessionSpec extends ObjectBehavior
{

    public $uuid = "347cbe53-ad85-423b-9b88-765b99571e0b";

    function let() {
        $this->beConstructedWith($this->uuid);

        if(isset($_COOKIE[$this->cookieName()->getWrappedObject()]))
            unset($_COOKIE[$this->cookieName()->getWrappedObject()]);
    }

    function it_should_construct_correct_cookie_name() {
        $this->cookieName()->shouldBe("Myna-347cbe53-ad85-423b-9b88-765b99571e0b");
        $this->cookieName()->shouldBeString();
    }

    function it_loads_variant_from_cookie_if_available() {
        $cookie = $this->cookieName()->getWrappedObject();
        $_COOKIE[$cookie] = 'catdogbird';
        $this->get()->shouldBe('catdogbird');
    }

    function it_saves_variant_when_set() {
        $this->get()->shouldBe(false);
        $this->put('catdogbird');
        $this->get()->shouldBe('catdogbird');
    }

}

?>