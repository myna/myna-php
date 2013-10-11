<?php

namespace spec\Myna\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExperimentSpec extends ObjectBehavior
{
    /**
     * @param \Myna\Data\Settings $settings
     * @param \Myna\Data\Variant $variant1
     * @param \Myna\Data\Variant $variant2
     */
    function let($settings, $variant1, $variant2) {
        $uuid = "347cbe53-ad85-423b-9b88-765b99571e0b";
        $id = "Test Experiment";

        $variant1->id = 'variant1';
        $variant2->id = 'variant2';

        $variants = array($variant1->id => $variant1, $variant2->id => $variant2);

        $this->beConstructedWith($uuid, $id, $settings, $variants);
    }

    function it_is_initializable() {
        $this->shouldHaveType('\Myna\Data\Experiment');
    }

    function it_returns_a_variant_on_suggest($variant1, $variant2) {
        $variant1->weight = 0.5;
        $variant2->weight = 0.5;

        $suggestion = $this->suggest();
        $suggestion->shouldHaveType('\Myna\Data\Variant');
    }

    function it_returns_correct_total_weight($variant1, $variant2) {
        $variant1->weight = 0.7;
        $variant2->weight = 0.3;

        $this->totalWeight()->shouldBe(1.0);
    }

    function it_returns_expected_variant_given_name() {
        $v1 = $this->variant('variant1');
        $v1->id->shouldBe('variant1');
        $v2 = $this->variant('variant2');
        $v2->id->shouldBe('variant2');
        $this->variant('foo')->shouldBe(false);
    }
}
