<?php namespace Myna;

/** An associative Array (or map) represented as a string. Useful for
 * storing data in cookies. */
class StringMap {

    /** Splits key and value */
    public static $kvDelimiter = '=';

    /** Splits key/value pairs */
    public static $pairDelimiter = ':';

    /**
     * Split a string into an associative Array using $kvDelimiter and
     * $pairDelimiter
     */
    public static function stringToArray($string) {
        $result = array();
        $kvs = explode(self::$pairDelimiter, $string);

        foreach($kvs as $kv) {
            $k_v = explode(self::$kvDelimiter, $kv);
            $key = urldecode($k_v[0]);
            $value = urldecode($k_v[1]);
            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * Convert an associative Array into a String using $kvDelimiter
     * and $pairDelimiter
     */
    public static function arrayToString($array) {
        $result = array();
        foreach($array as $key => $value) {
            array_push($result, urlencode($key) . self::$kvDelimiter . urlencode($value));
        }
        return implode(self::$pairDelimiter, $result);
    }

}

?>