<?php
namespace Let\Cache;

use Redis;

class Cache extends Redis
{
    public $redis;

    public static $instance = [];

    public function __construct(string $dbNode = 'master')
    {
        $config = APP_CONFIG['redis'][$dbNode];
        $this->redis = new Redis();
        $this->redis->connect($config['host'], $config['port'], $config['timeout'], $config['reserved'], $config['interval']);
        if (! empty($config['auth'])) {
            $this->redis->auth($config['auth']);
        }
        $this->redis->select($config['dbindex']);
    }

    public function __destruct()
    {
        //
    }

    public static function getInstance(string $dbNode = 'master', string $key = 'default'): self
    {
        if (isset(self::$instance[$dbNode][$key])) {
            return self::$instance[$dbNode][$key];
        }
        return self::$instance[$dbNode][$key] = new self($dbNode);
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
