<?php
namespace Hook\Db;

use Redis;
use Hook\Cache\Cache;

class RedisConnect extends Cache
{
    public $redis;
    
    public function __construct(string $name = 'master')
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
        $this->redis->select(APP_CONFIG['redis'][$name]['dbindex']);

        $this->redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
        $this->redis->setOption(Redis::OPT_PREFIX, APP_CONFIG['application']['name'].':');
    }
}