<?php namespace Myna;

/**
 * A Client that stores the Deployment in a Cache, saving network traffic.
 */
class CachingClient extends Client {

    public static function fromDeploymentUuid($uuid, $cachePath = '/tmp') {
        $sessionBuilder = function($expt) {
            return new CookieSession($expt->uuid);
        };

        $api = new Api($uuid, '//api.mynaweb.com/');

        $loader = function($deploymentUuid) use ($api) {
            return json_encode($api->getDeployment());
        };
        $cache = new FileCache($cachePath, $loader);

        return new CachingClient($uuid, $sessionBuilder, $cache);
    }

    public function __construct($deploymentUuid, $sessionBuilder, $cache) {
        $this->cache = $cache;
        $deployment = \Myna\Data\Deployment::fromArray(json_decode($cache->get($deploymentUuid), true));
        parent::__construct($deployment, $sessionBuilder);
    }

}

?>