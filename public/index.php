<?php
require __DIR__.'/../bootstrap.php';
$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
$app->bootstrap()->run();