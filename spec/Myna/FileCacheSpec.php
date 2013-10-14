<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileCacheSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith("/tmp", function() { return "corncrake"; });
    }

    function it_should_load_if_cache_does_not_exist()
    {
        if(file_exists("/tmp/foo"))
            delete('/tmp/foo');

        $this->get("foo")->shouldBe("corncrake");
    }
}
