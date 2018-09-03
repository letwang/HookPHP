<?php
chdir(dirname(__DIR__));
define('APP_ROOT', getcwd());
define('APP_NAME', 'store');
define('APP_PATH', APP_ROOT . '/app/'.APP_NAME);
define('APP_CONFIG', Yaconf::get(APP_NAME.'_'.YAF\ENVIRON));
define('APP_TABLE', Yaconf::get(APP_NAME.'_table'));

require APP_ROOT.'/vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
$app->bootstrap()->run();