<?php
declare(strict_types=1);

use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _initConfig(Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}

function l()
{
    return apcu_fetch('admin')['zh-CN'] + apcu_fetch(APP_NAME)['zh-CN'];
}