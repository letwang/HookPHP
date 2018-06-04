<?php
define('APP_PUBLIC', getcwd());
chdir(dirname(__DIR__));
define('APP_ROOT', getcwd());
define('APP_PATH', APP_ROOT . '/app/store');
define('APP_CONFIG', require APP_PATH . '/config/default.php');

$app = new Yaf\Application(APP_CONFIG);
$app->bootstrap()->run();