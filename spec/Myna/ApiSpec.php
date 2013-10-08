<?php

namespace spec\Myna;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApiSpec extends ObjectBehavior
{

    public $deploymentUuid = 'ae15f7c0-df1f-11e2-bfc7-7c6d628b25f7';

    function let() {
        $deploymentRoot = '//api.mynaweb.com';
        $apiRoot = '//api.mynaweb.com';
        $this->beConstructedWith($this->deploymentUuid, $apiRoot, $deploymentRoot);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myna\Api');
    }

    function it_should_get_a_deployment_when_asked() {
        $deployment = $this->getDeployment();
        $deployment->shouldHaveType('\Myna\Data\Deployment');
        $deployment->uuid->shouldBe($this->deploymentUuid);
    }
}
