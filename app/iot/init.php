<?php
use Yaf\Registry;
use Hook\Db\{OrmConnect, PdoConnect, RedisConnect, YacConnect};

define('APP_NAME', 'iot');
define('APP_CONFIG', Yaconf::get(APP_NAME.'_'.YAF\ENVIRON));
define('APP_TABLE', Yaconf::get('admin_table') + Yaconf::get(APP_NAME.'_table'));

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);

Registry::set('orm', OrmConnect::getInstance());
Registry::set('pdo', PdoConnect::getInstance());
Registry::set('redis', RedisConnect::getInstance());
Registry::set('yac', YacConnect::getInstance());