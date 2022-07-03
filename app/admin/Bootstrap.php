<?php
declare(strict_types=1);

use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _initConfig(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');

        defined('APP_ID') || define('APP_ID', AppModel::getInstance()->getDefaultId());
        foreach (ConfigModel::getInstance()->getDefined() as $key => $value) {
            defined($key) || define($key, $value);
        }
        defined('APP_LANG_ID') || define('APP_LANG_ID', LangModel::getInstance()->getDefaultId());
    }
}

function l()
{
    return apcu_fetch('admin')[APP_LANG_NAME] + apcu_fetch(APP_NAME)[APP_LANG_NAME];
}