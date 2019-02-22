<?php
namespace Base;
use Yaf\Dispatcher;

abstract class ApiController extends InitController
{
    protected function init()
    {
        parent::init();
        Dispatcher::getInstance()->autoRender(false);
        $this->_request->setParam('version', $this->_request->action)->setActionName($this->_request->method);
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