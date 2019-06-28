<?php
namespace Hook\Db;

use Redis;
use Hook\Cache\Cache;

class RedisConnect extends Cache
{
    public $handle;
    
    public function __construct(string $db = '')
    {
        $db = $db ? $db : 'default';
        $this->handle = new \Redis();
        $this->handle->connect(
            APP_CONFIG['redis'][$db]['host'],
            APP_CONFIG['redis'][$db]['port'],
            APP_CONFIG['redis'][$db]['timeout'],
            APP_CONFIG['redis'][$db]['reserved'],
            APP_CONFIG['redis'][$db]['interval']
        );
        if (! empty(APP_CONFIG['redis'][$db]['auth'])) {
            $this->handle->auth(APP_CONFIG['redis'][$db]['auth']);
        }

        $this->handle->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);
    }
}