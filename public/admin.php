<?php
require __DIR__.'/../app/admin/init.php';
$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
$app->bootstrap()->run();