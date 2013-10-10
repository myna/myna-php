<?php namespace Myna;

/**
 * A Session is a simple key-value store for storing variant
 * information for the current user for an Experiment. This should not
 * be confused with the PHP session -- Session implementations may
 * store data for longer (e.g. in a Cookie), nor store data at all.
 */
interface Session {

    /**
     * Gets the Variant name associated with the key in the Session,
     * or false if nothing has been saved for this Session.
     *
     * @param String key. The key we're inspecting.
     * @return String or false
     */
    public function get($key);


    /**
     * Puts the given Variant name into the Session
     *
     * @param String key. The key the variant name is stored under.
     * @param String variant. The variant name.
     */
    public function put($key, $variant);

}

?>