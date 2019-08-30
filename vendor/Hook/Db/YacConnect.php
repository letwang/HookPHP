<?php
namespace Hook\Db;

use Yaconf;
use Hook\Cache\Cache;

class YacConnect extends Cache
{
    public $handle;

    public function __construct(string $prefix = '')
    {
        $this->handle = new \Yac($prefix ? $prefix : 'default');
    }

    public function flush(): bool
    {
        $redis = RedisConnect::getInstance();
        $expiredKey = Yaconf::get('dicYac')['expired_key'];

        if (!$redis->handle->exists($expiredKey)) {
            return false;
        }

        $keys = [];
        foreach ($redis->handle->sMembers($expiredKey) as $table) {
            $keys[] = sprintf(Yaconf::get('dicRedis')['table']['single'], $table);
        }

        $this->handle->delete($keys);
        $redis->handle->unlink($expiredKey);

        return true;
    }
}