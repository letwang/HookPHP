<?php
declare(strict_types=1);

namespace Base;

use MenuModel;

abstract class ViewController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->_view->setScriptPath(APP_CONFIG['application']['directory'].($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/'.APP_THEME_NAME);
        $this->_view->assign(
            [
                'title' => l()['app']['title'],
                'keywords' => l()['app']['keywords'],
                'description' => l()['app']['description'],

                'id' => $this->id,
                'languages' => $this->languages,

                'module' => $this->_request->module,
                'controller' => $this->_request->controller,
                'action' => $this->_request->action,
                'uri' => $this->_request->getRequestUri(),
            ]
        );

        if (isset($_SESSION[APP_NAME])) {
            $this->_view->assign(
                [
                    'menus' => MenuModel::getInstance()->getMenu()
                ]
            );
        }

        // 列表模板渲染
        if (isset($this->cols)) {
            foreach ($this->cols as &$cols) {
                $cols['orderable'] = true;
                $cols['title'] = l()[$this->_request->controller][$cols['data']] ?? $cols['data'];
            }
            $this->_view->assign('cols', $this->cols);
        }
    }

    public function postAction()
    {

    }

    public function putAction()
    {

    }

    public function getAction()
    {
        $this->_view->display('list.phtml');
        return false;
    }
}