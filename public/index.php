<?php
define('APP_PUBLIC', getcwd());
chdir(dirname(__DIR__));
define('APP_ROOT', getcwd());
define('APP_PATH', APP_ROOT . '/app/Store');
define('APP_CONFIG', require APP_PATH . '/config/'.(YAF\ENVIRON).'.php');

require APP_ROOT.'/vendor/autoload.php';

$app = new Yaf\Application(APP_CONFIG);
$app->bootstrap()->run();