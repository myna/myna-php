<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringMapSpec extends ObjectBehavior
{
    function it_should_be_invertable() {
        $elements = array(
            "foo" => "bar",
            "f o" => "b=r",
            'f=o' => 'b:r'
        );

        $string = \Myna\StringMap::arrayToString($elements);
        $result = \Myna\StringMap::stringToArray($string);

        if($result === $elements) {
            // OK.
        } else {
            throw new \Exception("Results not equal to elements.");
        }
    }
}
