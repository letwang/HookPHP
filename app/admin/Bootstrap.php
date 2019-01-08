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

function l(string $key, ?int $langId = null)
{
    return Yaconf::get(APP_NAME.'_lang_'.($langId ?? $_SESSION[APP_NAME]['lang_id'] ?? APP_LANG).'.'.$key, $key);
}