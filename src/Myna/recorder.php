<?php namespace Myna;

class Recorder {

    public function __construct($client) {
        $this->client  = $client;
        $this->apiKey  = $client.apiKey;
        $this->apiRoot = $client.apiRoot;
    }

}

?>