<?php namespace Myna;

/**
 * A Session that saves the Variant name into a cookie.
 */
class CookieSession implements Session {

    /**
     * Construct a CookieSession.
     *
     * @param String uuid The UUID of the experiment this session is associated with
     * @param String cookie_base_name  The base part of the cookie name, to which the UUID is appended to form the complete cookie name. Defaults to "Myna"
     * @param Integer The lifetime of the cookie, in seconds. Added to time() whenever a cookie is set. Defaults to one year.
     */
    public function __construct($uuid, $cookie_base_name = "Myna", $cookie_life = 31536000) {
        $this->uuid = $uuid;
        $this->cookie_base_name = $cookie_base_name;
        $this->cookie_life = $cookie_life
    }

    public function get() {
        $_COOKIE
    }

    public function put($variant) {
        // Save the variant locally in case we want to access it
        // before we send the response (when it won't be in $_COOKIE)
        $this->variant = $variant
        setCookie($this->cookieName(), $variant, time() + $this->cookie_life)
    }

    /**
     * @return String The name of the cookie used by this CookieSession.
     */
    public function cookieName() {
        return "$this->cookie_base_name-$this->uuid"
    }

}

?>