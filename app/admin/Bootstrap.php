<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}

function l(string $key, int $langId = null): string
{
    return Yaconf::get(APP_NAME.'_lang_'.APP_LANG_NAME.'.'.$key, $key);
}