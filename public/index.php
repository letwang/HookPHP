<?php
define('APP_PUBLIC', getcwd());
chdir(dirname(__DIR__));
define('APP_ROOT', getcwd());
define('APP_PATH', APP_ROOT . '/app/store');

define('MEMORY', memory_get_usage(true));
define('MEMORYPEAK', memory_get_peak_usage(true));

$app = new Yaf\Application(APP_PATH . '/config/default.ini');
$app->bootstrap()->run();