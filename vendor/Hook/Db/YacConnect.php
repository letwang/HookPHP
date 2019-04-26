<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class YacConnect extends Cache
{
    public $handle;

    public function __construct(string $name = 'default')
    {
        $this->handle = new \Yac($name);
    }

    public function get(string $key, callable $callback = null, string $id = null, int $ttl = null)
    {
        $data = $this->handle->get($key);
        if (!$data && $callback) {
            $redis = RedisConnect::getInstance()->redis;
            $data = $callback($redis);
            $this->handle->set($key, $data, $ttl);
        }
        return $id ? ($data[$id] ?? null) : $data;
    }
}