<?php

/**
 * Interacts with the Myna API.
 */
class API {

    /**
     * Construct an API given the UUID of a deployment, and an API root.
     *
     * @param String deploymentUuid. The UUID of your deployment.
     * @param String apiRoot. The root of the API, defaults to //api.mynaweb.com
     */
    public function __construct($deploymentUuid, $apiRoot = '//api.mynaweb.com') {
        $this->apiRoot = $apiRoot;
        $this->deploymentUuid = $deploymentUuid;
    }

    /**
     * Get all the information associated with the deployment
     *
     * @return ???
     */
    public function get() {
        $url = "http:{$this->apiRoot}/v2/deployment/{$this->deploymentUuid}/myna.json";
        json_decode(file_get_contents($url));
    }

    // TODO
    public function record() {

    }

    // TODO
    public function reward() {

    }

}

?>