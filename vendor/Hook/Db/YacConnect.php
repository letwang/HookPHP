<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class YacConnect extends Cache
{
    public $yac;

    public function __construct(string $name = 'default')
    {
        $this->yac = new \Yac($name);
    }   
}