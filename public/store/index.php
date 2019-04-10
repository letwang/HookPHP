<?php
require __DIR__.'/../../app'.strrchr(__DIR__, '/').'/init.php';
$app = new Yaf\Application(['application' => APP_CONFIG['application']]);
$app->bootstrap()->run();