<?php namespace Myna;

// Utility functions
class Arr {

    // Return key from array if defined, otherwise return default
    public static function get($array, $key, $default = NULL) {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    public static function get_or_error($array, $key, $location = 'Undefined') {
        return isset($array[$key]) ? $array[$key] : Myna::error($location, "no $key in array", $array);
    }

}

?>