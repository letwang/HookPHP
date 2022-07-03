<?php
declare(strict_types=1);

require __DIR__ . '/../Init.php';

$install = false;
require __DIR__.'/../../../bin/install.php';

init('admin');