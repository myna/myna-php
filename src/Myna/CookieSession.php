<?php namespace Myna;

/**
 * A Session that saves information in a cookie. Keys and values are URL encoded.
 */
class CookieSession implements Session {

    /** We store an in-memory session so we can query values before
     * any cookies have been received.*/
    protected $session = array();

    /**
     * Construct a CookieSession.
     *
     * @param String uuid The UUID of the experiment this session is associated with
     * @param String cookie_base_name  The base part of the cookie name, to which the UUID is appended to form the complete cookie name. Defaults to "Myna"
     * @param Integer The lifetime of the cookie, in seconds. Added to time() whenever a cookie is set. Defaults to one year.
     */
    public function __construct($uuid, $cookie_base_name = "Myna", $cookie_life = 31536000) {
        Log::debug('new \Myna\CookieSession', $uuid, $cookie_base_name, $cookie_life);

        $this->uuid = $uuid;
        $this->cookie_base_name = $cookie_base_name;
        $this->cookie_life = $cookie_life;
    }

    public function get($key) {
        Log::debug("\Myna\CookieSession->get", $key);

        Log::debug("CookieSession cookieName is", $this->cookieName());
        Log::debug("CookieSession in-memory session is", $this->session);
        Log::debug("CookieSession _COOKIE is", $_COOKIE);

        $variant = false;

        if(Arr::get($this->session, $key, false)) {
            $variant = $this->session[$key];
        } elseif(isset($_COOKIE[$this->cookieName()])) {
            $cookie = $_COOKIE[$this->cookieName()];
            $array = StringMap::stringToArray($cookie);

            $variant = Arr::get($array, $key, false);
        }

        Log::debug("CookieSession variant is", $variant);
        return $variant;
    }

    public function put($key, $variant) {
        if(isset($_COOKIE[$this->cookieName()])) {
            $cookie = $_COOKIE[$this->cookieName()];
            $array = StringMap::stringToArray($cookie);

            $this->session = array_merge($array, $this->session);
        }

        $this->session[$key] = $variant;
        $cookie = StringMap::arrayToString($this->session);
        setCookie($this->cookieName(), $cookie, time() + $this->cookie_life);
    }

    /**
     * @return String The name of the cookie used by this CookieSession.
     */
    public function cookieName() {
        return "$this->cookie_base_name-$this->uuid";
    }

}

?>