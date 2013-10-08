<?php namespace Myna\Data;

class Deployment {

    /**
     * Construct a Deployment from an Array of data, typically from
     * JSON from the API.
     */
    public static function fromArray($options) {
        $name = "\Myna\Data\Deployment::fromArray";

        $uuid     = \Myna\Arr::get_or_error($options, 'uuid', $name);
        $apiKey   = \Myna\Arr::get_or_error($options, 'apiKey', $name);
        $apiRoot  = \Myna\Arr::get_or_error($options, 'apiRoot', $name);
        $latest   = \Myna\Arr::get_or_error($options, 'latest', $name);

        $experiments = array();
        $expts = \Myna\Arr::get($options, 'experiments', array());
        foreach ($expts as $expt) {
            array_push($experiments, Experiment::fromArray($expt));
        }

        return new Deployment($uuid, $apiKey, $apiRoot, $latest, $experiments);
    }

    /**
     * Construct a Deployment
     *
     * @param String uuid The UUID of this Deployment
     * @param String apiKey The API key used for experiments in this Deployment
     * @param String apiRoot The root of API (e.g. //api.mynaweb.com)
     * @param String latest The URL (without scheme) to find an up-to-date version of the Deployment (e.g. //api.mynaweb.com/v2/deployment/<uuid>/myna.json)
     * @param Array experiments An Array of \Myna\Data\Experiment
     */
    public function __construct($uuid, $apiKey, $apiRoot, $latest, $experiments) {
        $this->uuid = $uuid;
        $this->apiKey = $apiKey;
        $this->apiRoot = $apiRoot;
        $this->latest = $latest;
        $this->experiments = $experiments;
    }

}

?>