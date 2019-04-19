<?php
use Yaf\Registry;
use Hook\Db\YacConnect;

define('APP_NAME', 'store');
define('APP_CONFIG', Yaconf::get(APP_NAME.'_'.YAF\ENVIRON));
define('APP_TABLE', Yaconf::get(APP_NAME.'_table'));

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);

Registry::set('cache', YacConnect::getInstance(APP_NAME));
