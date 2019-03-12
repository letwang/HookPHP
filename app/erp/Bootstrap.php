<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');

        defined('APP_ID') || define('APP_ID', \AppModel::getDefaultId());
        foreach (\ConfigModel::getDefined() as $key => $value) {
            defined($key) || define($key, $value);
        }
        defined('APP_LANG_ID') || define('APP_LANG_ID', \LangModel::getDefaultId());
    }
}

function l(string $key): string
{
    return Yaconf::get(APP_NAME.'_lang_'.LangModel::getDefaultName().'.'.$key, $key);
}