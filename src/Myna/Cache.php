<?php

/**
 * A Cache stores experiment data (aka a deployment) in some kind of
 store to reduce the frequency of network accesses.
 */
interface Cache {

    /**
     * Retrieve experiment data, possibly blocking (making a network
     * request) to do son.
     *
     * return Array An array mapping String UUIDs to \Myna\Data\Experiment
     */
    public function get();

}

?>