<?php
declare(strict_types=1);

namespace Base;
abstract class ViewController extends AbstractController
{
    protected array $list = [];
    protected array $form = [];
    protected array $ignore = [];

    public function init()
    {
        parent::init();
        $this->_view->setScriptPath(APP_CONFIG['application']['directory'].($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/default');
        $this->_view->assign(
            [
                'title' => l()['app']['title'],
                'keywords' => l()['app']['keywords'],
                'description' => l()['app']['description'],

                'module' => $this->_request->module,
                'controller' => $this->_request->controller,
                'action' => $this->_request->action,
                'uri' => $this->_request->getRequestUri(),
            ]
        );
    }

    public function postAction()
    {
        
    }

    public function putAction()
    {
        
    }

    public function getAction()
    {
        
    }
}