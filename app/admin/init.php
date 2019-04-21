<?php
use Yaf\Registry;
use Hook\Db\YacConnect;

define('APP_NAME', PHP_SAPI === 'cli' ? 'admin' : 'iot');
define('APP_CONFIG', Yaconf::get('admin_'.YAF\ENVIRON));
define('APP_TABLE', Yaconf::get('admin_table') + Yaconf::get(APP_NAME.'_table'));

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);

Registry::set('cache', YacConnect::getInstance(APP_NAME));
