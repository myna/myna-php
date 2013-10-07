<?php

namespace Myna;

/**
 * A forgetful session doesn't remember anything. Use it when you want
 * to display a different variant to the same user everytime they
 * visit a page under test.
 */
class ForgetfulSession implements Session
{

    public function get() {
        return false;
    }

    public function put($variant) {
        // Do nothing
    }

}
