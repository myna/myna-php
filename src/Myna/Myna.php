<?php namespace Myna;

class Myna {

    public static function error($origin, $reason, $data) {
        $message = "$origin: $reason";
        Myna::var_dump_to_string($data, $message);
        throw new \Exception($message);
    }

    public static function var_dump_to_string($var, &$output, $prefix="") {
        if(is_string($var)) {
            $output .= $prefix.$var;
        } elseif(is_numeric($var)) {
            $output .= $prefix.strval($var);
        } elseif(is_bool($var)) {
            $output .= $prefix.($var ? "true" : "false");
        } elseif(is_object($var)) {
            $output .= $prefix.get_class($var);
        } elseif(is_null($var)){
            $output .= $prefix."NULL";
        } else {
          foreach($var as $key=>$value) {
              if(is_array($value)) {
                  $output .= $prefix.$key.": \n";
                  var_dump_to_string($value, $output, "  ".$prefix);
              } else {
                  $output.= $prefix.$key.": ".$value."\n";
              }
          }
        }
    }

    public static function init($deploymentUuid, $cachePath = '/tmp') {
        Log::debug("\Myna\Myna::init", $deploymentUuid, $cachePath);
        return CachingClient::fromDeploymentUuid($deploymentUuid, $cachePath);
    }

}

?>