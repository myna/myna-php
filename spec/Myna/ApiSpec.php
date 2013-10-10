<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApiSpec extends ObjectBehavior
{

    public $deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';

    function let() {
        $this->beConstructedWith($this->deploymentUuid);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myna\Api');
    }

    function it_should_get_a_deployment_when_asked() {
        $deployment = $this->getDeployment();
        $deployment->shouldHaveType('\Myna\Data\Deployment');
        $deployment->uuid->shouldBe($this->deploymentUuid);
        $deployment->latest->shouldBe('//api.mynaweb.com/v2/deployment/ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7/myna.json');
        $deployment->experiments->shouldHaveCount(10);
    }

    function it_should_get_an_updated_experiment_on_view() {
        $deployment = $this->getDeployment()->getWrappedObject();
        $experiment = $deployment->experiments[0];
        $updated = $this->view($deployment->apiKey, $experiment->uuid, $experiment->variants['default']->id);
        $updated->shouldHaveType('\Myna\Data\Experiment');
        $updated->uuid->shouldBe($experiment->uuid);
    }

    function it_should_get_an_updated_experiment_on_reward() {
        $deployment = $this->getDeployment()->getWrappedObject();
        $experiment = $deployment->experiments[0];
        $updated = $this->reward($deployment->apiKey, $experiment->uuid, $experiment->variants['default']->id);
        $updated->shouldHaveType('\Myna\Data\Experiment');
        $updated->uuid->shouldBe($experiment->uuid);
    }
}
