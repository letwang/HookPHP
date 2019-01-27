<?php
namespace Base;
abstract class ViewController extends InitController
{
    protected $fieldsList = [];
    protected $formList = [];

    protected function init()
    {
        parent::init();
        //全局模板路径
        $this->_view->setScriptPath(APP_ROOT.($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/'.APP_THEME);
        //全局META SEO
        $this->_view->assign(['title' => l('app.title'), 'keywords' => l('app.keywords'), 'description' => l('app.description')]);
        //初始化模板变量
        $this->_view->assign(
            [
                'module' => $this->_request->module,
                'controller' => strtolower($this->_request->controller),
                'action' => $this->_request->action,
                'languages' => \LangModel::getData(),
                'uri' => $this->_request->getRequestUri(),
                'menus' => \MenuModel::getClassify()
            ]
        );
    }

    protected function postAction()
    {
        //
    }

    protected function putAction()
    {
        $this->_view->assign(['id' => $this->id]);
    }

    protected function getAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }
}