<?php

namespace Myna;

/**
 * A forgetful session doesn't remember anything. Use it for testing.
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
