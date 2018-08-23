<?php
chdir(dirname(__DIR__));
define('APP_ROOT', getcwd());
define('APP_PATH', APP_ROOT . '/app/store');
define('APP_CONFIG', Yaconf::get('store_'.YAF\ENVIRON));

require APP_ROOT.'/vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
$app->bootstrap()->run();