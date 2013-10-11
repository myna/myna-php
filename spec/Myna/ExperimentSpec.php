<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExperimentSpec extends ObjectBehavior
{

    public $deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';

    function let() {
        $api = new \Myna\Api($this->deploymentUuid);
        $deployment = $api->getDeployment();
        $experiment = $deployment->experiments[1];
        $session = new \Myna\CookieSession($experiment->uuid);
        $apiKey = $deployment->apiKey;

        $this->beConstructedWith($experiment, $session, $api, $apiKey);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myna\Experiment');
    }

    function it_returns_a_variant_on_suggest() {
        $variant = $this->suggest();
        $variant->shouldHaveType('\Myna\Data\Variant');
    }

    function it_returns_same_variant_each_time_suggest_is_called() {
        $v1 = $this->suggest();
        $v2 = $this->suggest();

        $v1->shouldBe($v2);
    }

    function it_overwrites_suggestion_with_view() {
        $v1 = $this->suggest();
        switch ($v1->id->getWrappedObject()) {
        case 'a':
            $this->view('b');
            break;
        default:
            $this->view('a');
            break;
        }
        $v2 = $this->suggest();
        $v2->shouldNotBe($v1);
    }

    function it_rewards_successfully() {
        $v1 = $this->suggest();
        $this->reward(1.0);
    }

    function it_raises_an_error_if_reward_outside_range() {

    }
}
