<?php
use Yaf\{Session, Dispatcher, Bootstrap_Abstract};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        Session::getInstance()->start();

        $dispatcher->registerPlugin(new GlobalPlugin());

        $request = $dispatcher->getRequest();
        if (!$request->isGet()) {
            //CSRF
            $token = Session::getInstance()->get('user')['security']['token'];
            if ($token !== $request->getPost('token')) {
                throw new Exception('CSRF');
            }
            
            $dispatcher->setDefaultAction($request->getMethod());
        }

        if ($request->isXmlHttpRequest() || $request->isCli()) {
            $dispatcher->autoRender(false);
        }

        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}

function l(string $key, $langId = null)
{
    return Yaconf::get(APP_NAME.'_lang_'.($langId ?? Session::getInstance()->get('user')['lang_id']).'.'.$key, $key);
}