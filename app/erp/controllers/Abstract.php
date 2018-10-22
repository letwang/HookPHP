<?php
abstract class AbstractController extends Yaf\Controller_Abstract
{
    public $result = [];
    public $definition = [];

    public function init()
    {
        $viewPath = '';
        if ($this->_request->module !== 'Index') {
            $viewPath = 'modules/'.$this->_request->module;
        }
        $this->_view->setScriptPath(APP_ROOT.'/'.$viewPath.'/views/'.APP_THEME.'/');

        $this->_view->assign(['title' => l('application.title'), 'keywords' => l('application.keywords'), 'description' => l('application.description')]);
    }
}