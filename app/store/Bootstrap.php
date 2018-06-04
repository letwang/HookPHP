<?php
use Yaf\Session, Yaf\Dispatcher, Yaf\Application, Yaf\Bootstrap_Abstract, Yaf\Loader;

class Bootstrap extends Bootstrap_Abstract
{

    public $config;

    public function _init(Dispatcher $dispatcher)
    {
        // auto start session
        Session::getInstance()->start();
        
        // auto load config data
        $this->config = Application::app()->getConfig();
        
        // auto load framework
        Loader::import($this->config->application->library->directory . '/Autoload.php');
        
        // auto load plugin
        $dispatcher->registerPlugin(new GlobalPlugin());
        
        // auto save request
        $request = $dispatcher->getRequest();
        
        // auto set ajax is no render
        if ($request->isXmlHttpRequest()) {
            $dispatcher->autoRender(false);
        }
        
        // auto set http protocol to action except http get protocol
        if (! $request->isGet()) {
            $dispatcher->setDefaultAction($request->getMethod());
        }
    }
}