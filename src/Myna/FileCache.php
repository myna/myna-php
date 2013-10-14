<?php namespace Myna;

class FileCache {

    public static $delimiter = ':';

    public static function parse($data) {
        list($expiry_time, $data) = explode(FileCache::$delimiter, $data, 1);

        return array(intval($expiry_time), $data);
    }

    /**
     * @param String path. The location to store cached data
     * @param () -> String loader. A function to loader data if the cache is stale or doesn't exist.
     * @param Integer ttl. The time-to-live, in seconds, for a cached object. After this time it will be reloaded. Defaults to 15 minutes.
     */
    public function __construct($path, $loader, $ttl = 900) {
        $this->path = $path;
        $this->loader = $loader;
        $this->ttl = $ttl;
    }

    public function get($key) {
        $full_path = "{$this->path}/{$key}";

        if(file_exists($full_path)) {
            $file=fopen($full_path,'rb');
            flock($file, LOCK_SH);
            list($expiry_time, $data) = FileCache::parse(file_get_contents($full_path));
            fclose($file);

            if($this->has_expired($expiry_time)) {
                return $this->refresh($key);
            } else {
                return $data;
            }
        } else {
            return $this->refresh($key);
        }
    }

    protected function has_expired($expiry_time) {
        return($expiry_time < time());
    }

    protected function refresh($key) {
        // TODO: Fix thundering herd issue here.
        $expiry_time = time() + $this->ttl;
        $loader = $this->loader;
        $data = $loader();
        $full_data = $expiry_time . FileCache::$delimiter . $data;
        $full_path = "{$this->path}/{$key}";
        file_put_contents($full_path, $full_data, LOCK_EX);
        return $data;
    }

}

?>