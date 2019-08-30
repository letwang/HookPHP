<?php
define('APP_NAME', 'payment');
define('APP_CONFIG', Yaconf::get(APP_NAME.YAF\ENVIRON));
define('APP_TABLE', Yaconf::get('adminTable') + Yaconf::get(APP_NAME.'Table'));

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);