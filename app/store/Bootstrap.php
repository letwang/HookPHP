<?php
use Yaf\Session, Yaf\Registry, Yaf\Dispatcher, Yaf\Application, Yaf\Bootstrap_Abstract, Yaf\Loader;
use Let\Db\Db;

class Bootstrap extends Bootstrap_Abstract
{

    public $config;

    public function _init(Dispatcher $dispatcher)
    {
        // auto start session
        Session::getInstance()->start();
        
        // auto load config data
        $this->config = Application::app()->getConfig();
        Registry::set('Config', $this->config);
        
        // auto load framework
        Loader::import($this->config->application->library->directory . '/Autoload.php');
        
        // auto load redis
        $redis = new Redis();
        $redis->connect($this->config->redis->host, $this->config->redis->port, $this->config->redis->timeout, $this->config->redis->reserved, $this->config->redis->interval);
        if (! empty($this->config->redis->auth)) {
            $redis->auth($this->config->redis->auth);
        }
        Registry::set('Redis', $redis);
        
        // auto load mysql
        Registry::set('Db', new Db());
        
        // auto load model
        Registry::set('I18n', new I18nModel($redis, $this->config->application->name, 'zh_CN'));
        Registry::set('Cache', new CacheModel($redis, $this->config->application->name));
        Registry::set('Table', new TableModel());
        
        // auto load Analysis model
        
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