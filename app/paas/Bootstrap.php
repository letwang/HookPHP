<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new HookPlugin());

        $request = $dispatcher->getRequest();
        if (!$request->isGet()) {
            $dispatcher->setDefaultAction($request->getMethod());
        }

        if ($request->isXmlHttpRequest()) {
            $dispatcher->autoRender(false);
        }
        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}

function l(string $key): string
{
    return Yaconf::get(APP_NAME.'_lang_'.APP_LANG_NAME.'.'.$key, $key);
}