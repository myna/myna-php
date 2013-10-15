<?php namespace Myna;

// Utility functions
class Arr {

    // Return key from array if defined, otherwise return default
    public static function get($array, $key, $default = NULL) {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    /**
     * @param Array array
     * @param Array[String] keys
     * @param Any default
     */
    public static function get_nested($array, $keys, $default = NULL) {
        $data = $array;
        $value = $default;

        foreach($keys as $idx => $key) {
            $value = Arr::get($data, $key, $default);
            if($value === $default) {
                return $default;
            } else {
                $data = $value;
            }
        }

        return $value;
    }

    public static function get_or_error($array, $key, $location = 'Undefined') {
        return isset($array[$key]) ? $array[$key] : Myna::error($location, "no $key in array", $array);
    }

}

?>