<?php namespace Myna;

class Myna {

    public static function error($origin, $reason, $data) {
        $message = "$origin: $reason";
        var_dump_to_string($data, $message);
        throw new Exception($message);
    }

    function var_dump_to_string($var, &$output, $prefix="") {
        foreach($var as $key=>$value) {
            if(is_array($value)) {
                $output.= $prefix.$key.": \n";
                var_dump_to_string($value, $output, "  ".$prefix);
            } else {
                $output.= $prefix.$key.": ".$value."\n";
            }
        }
    }

}

?>