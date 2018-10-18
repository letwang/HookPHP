<?php
use Yaf\{Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        session_start();

        $dispatcher->registerPlugin(new GlobalPlugin());

        $request = $dispatcher->getRequest();
        if (!$request->isGet()) {
            $dispatcher->setDefaultAction($request->getMethod());
        }

        if ($request->isXmlHttpRequest()) {
            $dispatcher->autoRender(false);
        }

        $dispatcher->initView(APP_PATH.'/views/'.THEME_NAME.'/');
        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}

function l(string $key, $langId = null)
{
    $langId = $langId ?? $_SESSION[APP_NAME]['lang_id'] ?? 1;
    return Yaconf::get(APP_NAME.'_lang_'.$langId.'.'.$key, $key);
}