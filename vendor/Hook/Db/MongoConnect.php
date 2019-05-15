<?php
namespace Hook\Db;

use Hook\Cache\Cache;

class MongoConnect extends Cache
{
    public $handle;
    
    public function __construct(string $name = 'default')
    {
        $this->handle = new \MongoDB\Client(
            APP_CONFIG['mongo'][$name]['uri'],
            APP_CONFIG['mongo'][$name]['uriOptions'],
            APP_CONFIG['mongo'][$name]['driverOptions']
        );
    }   
}