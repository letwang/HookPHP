<?php
namespace Hook\Db;

use Redis;
use Hook\Cache\Cache;

class RedisConnect extends Cache
{
    public $handle;
    
    public function __construct(string $name = 'default')
    {
        $this->handle = new \Redis();
        $this->handle->connect(
            APP_CONFIG['redis'][$name]['host'],
            APP_CONFIG['redis'][$name]['port'],
            APP_CONFIG['redis'][$name]['timeout'],
            APP_CONFIG['redis'][$name]['reserved'],
            APP_CONFIG['redis'][$name]['interval']
        );
        if (! empty(APP_CONFIG['redis'][$name]['auth'])) {
            $this->handle->auth(APP_CONFIG['redis'][$name]['auth']);
        }

        $this->handle->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);
    }

    public function getHash(string $key, string $hashKey, callable $callback = null, int $ttl = null)
    {
        if ($this->handle->hExists($key, $hashKey)) {
            return $this->handle->hGet($key, $hashKey);
        } else {
            $value = $callback($this->handle);
            $this->handle->hSet($key, $hashKey, $value);
            $this->handle->setTimeout($key, $ttl);
            return $value;
        }
    }
}