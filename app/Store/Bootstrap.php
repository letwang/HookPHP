<?php
use Yaf\{Session, Dispatcher, Bootstrap_Abstract, Loader};

class Bootstrap extends Bootstrap_Abstract
{
    public function _init(Dispatcher $dispatcher)
    {
        Session::getInstance()->start();

        $dispatcher->registerPlugin(new GlobalPlugin());

        $request = $dispatcher->getRequest();

        if ($request->isXmlHttpRequest()) {
            $dispatcher->autoRender(false);
        }

        if (!$request->isGet()) {
            $dispatcher->setDefaultAction($request->getMethod());
        }

        //Loader::getInstance()->registerLocalNamespace('Hook');
    }
}