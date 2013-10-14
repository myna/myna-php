<?php namespace Myna;

/**
 * A Cache stores experiment data (aka a deployment) in some kind of
 store to reduce the frequency of network accesses.
 */
interface Cache {

    /**
     * Retrieve experiment data, possibly blocking (making a network
     * request) to do son.
     *
     * @param String $key. The key for the cached data.
     * @return String The cached data.
     */
    public function get($key);

}

?>