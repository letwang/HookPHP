<?php
namespace Hook\Db;

use Yaconf;
use Hook\Db\{RedisConnect};
use Hook\Cache\Cache;

class YacConnect extends Cache
{
    public $handle;
    public $redis;

    public function __construct(string $prefix = '')
    {
        $this->handle = new \Yac($prefix ? $prefix : 'default');
        $this->redis = RedisConnect::getInstance();
    }

    public function flushTable(): bool
    {
        $expiredKey = Yaconf::get('const')['yac']['expired_key'];

        if (!$this->redis->handle->exists($expiredKey)) {
            return true;
        }

        foreach ($this->redis->handle->sMembers($expiredKey) as $table) {
            foreach (Yaconf::get('const')['table'] as $key) {
                $key = sprintf($key, $table);
                $this->handle->delete($key);
                $this->redis->handle->del($key);
            }
        }
        $this->redis->handle->del($expiredKey);

        return true;
    }
}