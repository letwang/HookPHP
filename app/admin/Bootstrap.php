<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};
use Hook\Db\{YacConnect};


class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');

        defined('APP_ID') || define('APP_ID', AppModel::getInstance()->getDefaultId());
        foreach (ConfigModel::getInstance()->getDefined() as $key => $value) {
            defined($key) || define($key, $value);
        }
        defined('APP_LANG_ID') || define('APP_LANG_ID', LangModel::getInstance()->getDefaultId());

        YacConnect::getInstance()->flush();
    }
}

function l(string $key)
{
    return Yaconf::get('admin_lang_'.APP_LANG_NAME.'.'.$key, $key);
}