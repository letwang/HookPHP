<?php
define('APP_NAME', 'store');
define('APP_CONFIG', Yaconf::get(APP_NAME.'_'.YAF\ENVIRON));
define('APP_TABLE', Yaconf::get('admin_table') + Yaconf::get(APP_NAME.'_table'));

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);