<?php namespace myna;

class Client {

    public function __construct($options = array()) {
        $this->uuid = isset($options['uuid']) ? $options['uuid'] : NULL;
        $this->apiKey = isset($options['apiKey']) ? $options['apiKey'] : Myna.error("Myna.Client constructor", "no apiKey in options", options);
        $this->apiRoot = isset($options['apiRoot']) ? $options['apiRoot'] : "//api.mynaweb.com";
        $this->settings = isset($options['settings']) ? $options['settings'] : array();

        $experiments = array();
        $expts = isset($options['experiments']) ? $options['experiments'] : array()
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