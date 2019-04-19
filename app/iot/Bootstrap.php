<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new HookPlugin());

        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}

function l(string $key): string
{
    return Yaconf::get(APP_NAME.'_lang_zh-cn.'.$key, $key);
}