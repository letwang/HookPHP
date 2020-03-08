<?php
namespace Hook\Cache;

use Hook\Db\{PdoConnect, RedisConnect, YacConnect};

class Cache
{
    public object $pdo;
    public object $redis;
    public object $yac;

    public function __construct()
    {
        $this->pdo = PdoConnect::getInstance();
        $this->redis = RedisConnect::getInstance();
        $this->yac = YacConnect::getInstance();
    }

    public static function getInstance(string $name = '', string $key = 'default'): self
    {
        $class = static::class;
        $instance = &self::static($class);
        if (isset($instance[$name][$key])) {
            return $instance[$name][$key];
        }
        return $instance[$name][$key] = new $class($name);
    }

    public static function &static(string $name, $defaultValue = null, bool $reset = false)
    {
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

    public static function staticReset(string $name = null): void
    {
        self::static($name, null, true);
    }
}