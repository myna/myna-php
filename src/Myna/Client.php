<?php namespace Myna;

class Client {

    public function __construct($deploymentUuid, $api, $sessionBuilder) {
        $this->api = $api;
        $this->deployment = $this->api.getDeployment();
        $this->experiments = array();

        foreach ($this->deployment->experiments as $expt) {
            $experiment = new Experiment(
                $expt,
                $sessionBuilder(),
                $this->api,
                $this->deployment->apiKey,
                $expt->sticky()
            );
            $this->experiments[$expt.id] = $experiment;
        }
    }

    public function suggest($exptId) {
        $this->experiments[$exptId].suggest();
    }

    public function view($exptId, $variantId) {
        $this->experiments[$exptId].view($variantId);
    }

    public function reward($exptId, $amount = 1.0) {
        $this->experiments[$exptId].reward($amount);
    }

}

?>