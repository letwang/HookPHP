<?php
require __DIR__ . '/vendor/Hook/File/File.php';

use Hook\File\File;

$value = [];

foreach (File::findFiles(__DIR__ . '/config', '*.php') as $file) {
    $value['global'][basename($file, '.php')] = require $file;
}

foreach (glob(__DIR__ . '/app/*', GLOB_ONLYDIR) as $appDir) {
    foreach (File::findFiles($appDir . '/config', '*.php') as $file) {
        $value[basename($appDir)][basename($file, '.php')] = require $file;
    }
}

apcu_add($value);