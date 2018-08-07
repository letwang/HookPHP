<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class MongoConnect extends Cache
{
    public $mongo;
    
    public function __construct(string $name = 'master')
    {
        $this->mongo = new \MongoDB\Client(
            APP_CONFIG['mongo'][$name]['uri'],
            APP_CONFIG['mongo'][$name]['uriOptions'],
            APP_CONFIG['mongo'][$name]['driverOptions']
        );
    }   
}