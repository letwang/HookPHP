<?php
namespace Base;
abstract class ViewController extends AbstractController
{
    protected $list = [];
    protected $form = [];
    protected $ignore = [];

    protected function init()
    {
        parent::init();
        $this->_view->setScriptPath(APP_CONFIG['application']['directory'].($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/default');
        $this->_view->assign(
            [
                'title' => l('app.title'),
                'keywords' => l('app.keywords'),
                'description' => l('app.description'),

                'module' => $this->_request->module,
                'controller' => strtolower($this->_request->controller),
                'action' => $this->_request->action,
                'uri' => $this->_request->getRequestUri(),
            ]
        );
    }

    protected function postAction()
    {
        
    }

    protected function putAction()
    {
        
    }

    protected function getAction()
    {
        
    }
}