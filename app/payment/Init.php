<?php
declare(strict_types=1);

isset($_SERVER['REQUEST_ID']) && SeasLog::setRequestID($_SERVER['REQUEST_ID']);

define('APP_NAME', 'payment');
define('APP_CONFIG', apcu_fetch(APP_NAME)[YAF\ENVIRON]);
define('APP_TABLE', apcu_fetch('admin')['table'] + apcu_fetch(APP_NAME)['table']);

require __DIR__.'/../../vendor/autoload.php';

$app = new Yaf\Application(['application' => APP_CONFIG['application']]);