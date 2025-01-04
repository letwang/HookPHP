<?php
define("APPLICATION_PATH",  dirname(__DIR__));

$app  = new Yaf\Application(APPLICATION_PATH . "/config/application.ini");
$app->bootstrap()->run();