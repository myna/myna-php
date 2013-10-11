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

    function it_should_be_a_session() {
        $this->shouldBeAnInstanceOf('Myna\Session');
    }

    function it_should_construct_correct_cookie_name() {
        $this->cookieName()->shouldBe("Myna-347cbe53-ad85-423b-9b88-765b99571e0b");
        $this->cookieName()->shouldBeString();
    }

    function it_loads_variant_from_cookie_if_available() {
        $cookie = $this->cookieName()->getWrappedObject();
        $_COOKIE[$cookie] = 'foo=catdogbird';
        $this->get('foo')->shouldBe('catdogbird');
    }

    function it_saves_variant_when_set() {
        $this->get('foo')->shouldBe(false);
        $this->put('foo', 'catdogbird');
        $this->get('foo')->shouldBe('catdogbird');
    }

    function it_handles_equal_sign_in_key_and_variant_name() {
        $this->put('1=1', '2=2');
        $this->get('1=1')->shouldBe('2=2');
    }

    function it_prefers_put_value_over_cookie_value() {
        $cookie = $this->cookieName()->getWrappedObject();
        $_COOKIE[$cookie] = 'foo=catdogduck';
        $this->put('foo', 'catdogbird');
        $this->get('foo')->shouldBe("catdogbird");

    }

}

?>