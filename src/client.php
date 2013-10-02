<?php namespace Myna;

class Client {

    public function __construct($options = array()) {
        $this->uuid     = Arr::get($options, 'uuid');
        $this->apiKey   = Arr::get_or_error($options, 'apiKey', "Myna::Client constructor");
        $this->apiRoot  = Arr::get($options, 'apiRoot', '//api.mynaweb.com');
        $this->settings = Arr::get($options, 'settings', array());

        $experiments = array();
        $expts = Arr::get($options, 'experiments', array());
        foreach ($expts as $expt) {
            $experiments[$expt.id] = $expt
        }
    }

    public function suggest($exptId) {
        // Do something
    }

    public function view($exptId, $variantId) {
        // Do something
    }

    public function reward($exptId, $amount = 1.0) {
        // Do something
    }

}


?>