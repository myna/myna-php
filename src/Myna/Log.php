<?php namespace Myna;

/**
 * Very simple standalone logging.
 */
class Log {

    /**
     * True is logging in enabled. Defaults to false.
     */
    public static $enabled = false;

    public static $DEBUG = "DEBUG";
    public static $INFO = "INFO";

    /**
     * Log data. You may pass in any number of arguments.
     */
    public static function log() {
        if(Log::$enabled) {
            $data = array();
            $args = func_get_args();

            foreach($args as $arg) {
                $message = "";
                Myna::var_dump_to_string($arg, $message);
                array_push($data, $message);
            }

            //$stderr = fopen('php://stderr', 'w');
            //fwrite($stderr, implode(' ', $data));
            //fclose($stderr);
            error_log(implode(' ', $data));
        }
    }

    public static function debug() {
        $data = func_get_args();
        array_unshift($data, Log::$DEBUG);
        call_user_func_array('\Myna\Log::log', $data);
    }

    public static function info() {
        $data = func_get_args();
        array_unshift($data, Log::$INFO);
        call_user_func_array('\Myna\Log::log', $data);
    }

}

?>