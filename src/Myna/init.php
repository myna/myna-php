<?php namespace Myna;

class Init {

    public static function local($json) {
        return $json;
    }

    // URL (String) -> JSON (Array)
    public static function remote($url) {
        return Init::local(json_decode(file_get_contents($url), true));
    }
}

?>