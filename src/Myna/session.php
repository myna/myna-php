<?php namespace Myna;

/**
 * A Session stores the current variant (if any) for the current user
 * for an Experiment. This should not be confused with the PHP session
 * -- Session implementations may stored data for longer (e.g. in a
 * Cookie), nor store data at all.
 */
interface Session {

    /**
     * Gets the Variant name saved in the Session, or false if nothing
     * has been saved for this Session.
     *
     * @return String or false
     */
    public function get();


    /**
     * Puts the given Variant name into the Session
     *
     * @param String variant
     */
    public function put($variant);

}

?>