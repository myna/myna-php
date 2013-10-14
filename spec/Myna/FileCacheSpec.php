<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileCacheSpec extends ObjectBehavior
{

    public $cacheFile = '/tmp/foo';

    public function write_cache($file, $ttl, $data) {
        if($ttl === false) {
            $ttl = 60;
        }
        $expiry_time = $ttl + time();
        file_put_contents($file,"{$expiry_time}:{$data}");
    }

    function let() {
        $this->beConstructedWith("/tmp", function() { return "corncrake"; });
        $this->write_cache($this->cacheFile, false, "crabcakes");
    }

    function letgo() {
        if(file_exists($this->cacheFile))
            unlink($this->cacheFile);
    }

    function it_should_return_cached_value() {
        $this->get("foo")->shouldBe("crabcakes");
    }

    function it_should_load_if_cache_does_not_exist() {
        if(file_exists($this->cacheFile))
            unlink($this->cacheFile);

        $this->get("foo")->shouldBe("corncrake");
    }

    function it_should_load_if_cache_expires() {
        $this->write_cache($this->cacheFile, -10, "crabcakes");

        $this->get("foo")->shouldBe("corncrake");
    }
}
