<?php namespace Myna;

/**
 * A Session that saves information in a cookie. Keys and values are URL encoded.
 */
class CookieSession implements Session {

    /** Splits key and value */
    public static $kvDelimiter = '=';
    /** Splits key/value pairs */
    public static $pairDelimiter = ':';

    /** Split a string into an Array using $kvDelimiter and $pairDelimiter */
    public static function stringToArray($string) {
        $result = array();
        $kvs = explode($pairDelimiter, $string);

        foreach($kvs as $kv) {
            $k_v = explode($kvDelimiter, $kv);
            $key = url_decode($k_v[0]);
            $value = url_decode($k_v[1]);
            $result[$key] = $value;
        }

        return $result;
    }


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
        $this->cookie_life = $cookie_life;
    }

    public function get($key) {
        $variant = false;

        if(isset($_COOKIE[$this->cookieName()])) {
            $variant = $_COOKIE[$this->cookieName()];
            $this->variant = $variant;

        } elseif(isset($this->variant)) {
            $variant = $this->variant;
        }

        return $variant;
    }

    public function put($key, $variant) {
        $encoded_key = urlencode($key);
        $encoded_variant = urlencode($key);

        // Save the variant locally in case we want to access it
        // before we send the response (when it won't be in $_COOKIE)
        $this->variant = $variant;
        setCookie($this->cookieName(), $variant, time() + $this->cookie_life);
    }

    /**
     * @return String The name of the cookie used by this CookieSession.
     */
    public function cookieName() {
        return "$this->cookie_base_name-$this->uuid";
    }

}

?>