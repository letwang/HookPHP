<?php
namespace Base;
use Yaf\Dispatcher;

abstract class ApiController extends InitController
{
    protected $model;

    protected function init()
    {
        parent::init();
        Dispatcher::getInstance()->autoRender(false);
        $this->_request->setParam('version', $this->_request->action)->setActionName($this->_request->method);

        $class = str_replace('_', '\\', $this->_request->controller).'Model';
        $this->model = new $class($this->id);
    }

    protected function postAction()
    {
        return $this->send($this->model->post());
    }

    protected function deleteAction()
    {
        return $this->send($this->model->delete());
    }

    protected function putAction()
    {
        return $this->send($this->model->put());
    }

    protected function getAction()
    {
        return $this->send($this->model->get());
    }
}