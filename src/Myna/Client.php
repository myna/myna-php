<?php namespace Myna;

class Client {

    /**
     * Construct a Client from a Deployment
     *
     * @param \Myna\Data\Deployment deployment
     * @return \Myna\Client
     */
    public static function fromDeployment($deployment) {
        $api = new Api($deployment->uuid, $deployment->apiRoot);
        $sessionBuilder = function($expt) {
            return new CookieSession($expt->uuid);
        };

        return new Client($api, $sessionBuilder);
    }

    public function __construct($api, $sessionBuilder) {
        $this->api = $api;
        $this->deployment = $this->api.getDeployment();
        $this->experiments = array();

        foreach ($this->deployment->experiments as $expt) {
            $experiment = new Experiment(
                $expt,
                $sessionBuilder($expt),
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