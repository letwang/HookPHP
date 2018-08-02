<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class MongoConnect extends Cache
{
    public $mongo;
    
    public function __construct(string $node = 'master')
    {
        $this->mongo = new \MongoDB\Client(
            APP_CONFIG['mongo'][$node]['uri'],
            APP_CONFIG['mongo'][$node]['uriOptions'],
            APP_CONFIG['mongo'][$node]['driverOptions']
        );
    }   
}