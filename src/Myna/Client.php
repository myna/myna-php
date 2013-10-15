<?php namespace Myna;

class Client {

    /**
     * Construct a Client from a Deployment
     *
     * @param \Myna\Data\Deployment deployment
     * @return \Myna\Client
     */
    public static function fromDeployment($deployment) {
        $sessionBuilder = function($expt) {
            return new CookieSession($expt->uuid);
        };

        return new Client($deployment, $sessionBuilder);
    }

    public function __construct($deployment, $sessionBuilder) {
        $this->deployment = $deployment;
        $this->api = new Api($deployment->uuid, $deployment->apiRoot);
        $this->experiments = array();

        foreach ($this->deployment->experiments as $expt) {
            $experiment = new Experiment(
                $expt,
                $sessionBuilder($expt),
                $this->api,
                $this->deployment->apiKey,
                $expt->is_sticky()
            );
            $this->experiments[$expt->id] = $experiment;
        }
    }

    public function suggest($exptId) {
        return $this->experiments[$exptId]->suggest();
    }

    public function view($exptId, $variantId) {
        return $this->experiments[$exptId]->view($variantId);
    }

    public function reward($exptId, $amount = 1.0) {
        return $this->experiments[$exptId]->reward($amount);
    }

}

?>