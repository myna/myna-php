<?php namespace Myna;

/**
 * A Client that stores the Deployment in a Cache, saving network traffic.
 */
class CachingClient extends Client {

    public static function fromDeploymentUuid($uuid, $cachePath = '/tmp') {
        $sessionBuilder = function($expt) {
            return new CookieSession($expt->uuid);
        };

        $loader = function($deploymentUuid) {
            return $api.getDeployment();
        };
        $cache = new FileCache($cachePath, $loader);

        return new CachingClient($uuid, $sessionBuilder, $cache);
    }

    public function __construct($deploymentUuid, $sessionBuilder, $cache) {
        $this->cache = $cache;
        $deployment = $cache.get($deploymentUuid);
        super($deployment, $sessionBuilder);
    }

}

?>