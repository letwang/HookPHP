<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class YacConnect extends Cache
{
    public $handle;

    public function __construct(string $prefix = '')
    {
        $this->handle = new \Yac($prefix ? $prefix : 'default');
    }
}