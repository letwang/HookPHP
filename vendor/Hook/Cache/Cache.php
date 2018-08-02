<?php
namespace Hook\Cache;

class Cache
{
    public static $instance = [];

    public static function getInstance(string $node = 'master', string $key = 'default'): self
    {
        $class = get_called_class();
        if (isset(self::$instance[$class][$node][$key])) {
            return self::$instance[$class][$node][$key];
        }
        return self::$instance[$class][$node][$key] = new $class($node);
    }

    public static function &static($name, $defaultValue = null, $reset = false) {
        static $data = [], $default = [];
        if (isset($data[$name]) || array_key_exists($name, $data)) {
            if ($reset) {
                $data[$name] = $default[$name];
            }
            return $data[$name];
        }
        if (isset($name)) {
            if ($reset) {
                return $data;
            }
            $default[$name] = $data[$name] = $defaultValue;
            return $data[$name];
        }
        foreach ($default as $name => $value) {
            $data[$name] = $value;
        }
        return $data;
    }

    public static function staticReset($name = null) {
        self::static($name, null, true);
    }
}
