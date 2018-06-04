<?php
spl_autoload_register(
    function ($class) {
        $class = explode('\\', $class);
        $file = array_pop($class);
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'letframework' . DIRECTORY_SEPARATOR . strtolower(join('-', $class)) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $file . '.php';
        is_file($file) && include $file;
    }
);