<?php
require __DIR__.'/../app/paas/init.php';
$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
$app->bootstrap()->run();