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
        //$this->handle->setOption(Redis::OPT_PREFIX, APP_NAME.':');
    }

    public function multi(callable $callback, int $type = Redis::MULTI)
    {
        $redis = $this->handle->multi($type);
        $callback($redis);
        return $redis->exec();
    }
}