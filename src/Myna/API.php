<?php

/**
 * Interacts with the Myna API.
 */
class API {

    /**
     * Construct an API given the UUID of a deployment, and an API root.
     *
     * @param String deploymentUuid. The UUID of your deployment.
     * @param String deploymentRoot. The root of the deployment API; defaults to //deploy.mynaweb.com
     * @param String apiRoot. The root of the API; defaults to //api.mynaweb.com
     */
    public function __construct($deploymentUuid, $apiRoot = '//api.mynaweb.com', $deploymentRoot = '//deploy.mynaweb.com') {
        $this->deploymentUuid = $deploymentUuid;
        $this->deploymentRoot = $deploymentRoot;
        $this->apiRoot = $apiRoot;
    }

    /**
     * Get all the information associated with the deployment
     *
     * @return Array An Array mapping String UUID to \Myna\
     */
    public function getDeployment() {
        $url = "http:{$this->deploymentRoot}/v2/deployment/{$this->deploymentUuid}/myna.json";
        json_decode(file_get_contents($url));
    }

    /**
     * Record a view of a variant.
     *
     * @param String experimentUuid. The UUID of the experiment
     * @param String variant. The name of the variant that was viewed.
     */
    public function view($experimentUuid, $variant) {
        $url = "http:{$this->apiRoot}/v2/experiment/{$experimentUuid}/record?variant={$variant}";
        json_decode(file_get_contents($url));
    }

    /**
     * Record a reward for a variant.
     *
     * @param String experimentUuid. The UUID of the experiment
     * @param String variant. The name of the variant that was rewarded.
     * @param Doulbe amount. The amount of the reward between 0.0 and 1.0. Defaults to 1.0.
     */
    public function reward($experimentUuid, $variant, $amount = 1.0) {
        $url = "http:{$this->apiRoot}/v2/experiment/{$experimentUuid}/record?variant={$variant}&amount={$amount}";
    }


    /**
     * Parse a response from the server
     *
     * @param String data
     * @return Array or true
     */
    function parse_response($data) {
        $json = json_decode($data, true);
        if(isnull($json))
            Myna::error("Myna\API.parse_response", "Response from server is not JSON.", $data);

        switch ($json['typename']) {
        case 'problem':
            return Myna::error("Myna\API.parse_response", "Server responded with error", $json['messages']);
        case 'experiment':
            return \Myna\Data\Experiment::fromArray($json);
        case 'deployment':
            return \Myna\Data\Deployment::fromArray($json);
        case 'ok':
            return true;
        default:
            return Myna::error("Myna\Api.parse_response", "Unexpected JSON response", $json);
        }
    }

}

?>