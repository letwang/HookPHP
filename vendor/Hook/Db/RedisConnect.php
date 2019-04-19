<?php
namespace Hook\Db;

use Redis;
use Hook\Cache\Cache;

class RedisConnect extends Cache
{
    public $redis;
    
    public function __construct(string $name = 'default')
    {
        $this->redis = new \Redis();
        $this->redis->connect(
            APP_CONFIG['redis'][$name]['host'],
            APP_CONFIG['redis'][$name]['port'],
            APP_CONFIG['redis'][$name]['timeout'],
            APP_CONFIG['redis'][$name]['reserved'],
            APP_CONFIG['redis'][$name]['interval']
        );
        if (! empty(APP_CONFIG['redis'][$name]['auth'])) {
            $this->redis->auth(APP_CONFIG['redis'][$name]['auth']);
        }

        $this->redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);
        //$this->redis->setOption(Redis::OPT_PREFIX, APP_NAME.':');
    }

    public function multi(callable $callback, int $type = Redis::MULTI)
    {
        $redis = $this->redis->multi($type);
        $callback($redis);
        return $redis->exec();
    }
}