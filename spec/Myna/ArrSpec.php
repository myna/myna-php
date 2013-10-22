<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrSpec extends ObjectBehavior
{
    function it_gets_corrected_nested_index() {
        $array = array('a' => array('b' => array('c' => 'bingo!')));
        $keys = array('a', 'b', 'c');
        assert(\Myna\Arr::get_nested($array, $keys, false) === 'bingo!');
    }

    function it_returns_default_if_nested_index_not_found() {
        $array = array('a' => array('b' => array('c' => 'bingo!')));
        $keys = array('a', 'b', 'd');
        assert(\Myna\Arr::get_nested($array, $keys, false) === false);
        $keys = array('a', 'g');
        assert(\Myna\Arr::get_nested($array, $keys, false) === false);
    }
}
