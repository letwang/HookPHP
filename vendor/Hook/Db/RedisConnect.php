<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class RedisConnect extends Cache
{
    public $redis;
    
    public function __construct(string $node = 'master')
    {
        $this->redis = new \Redis();
        $this->redis->connect(
            APP_CONFIG['redis'][$node]['host'],
            APP_CONFIG['redis'][$node]['port'],
            APP_CONFIG['redis'][$node]['timeout'],
            APP_CONFIG['redis'][$node]['reserved'],
            APP_CONFIG['redis'][$node]['interval']
        );
        if (! empty(APP_CONFIG['redis'][$node]['auth'])) {
            $this->redis->auth(APP_CONFIG['redis'][$node]['auth']);
        }
        $this->redis->select(APP_CONFIG['redis'][$node]['dbindex']);
    }
}