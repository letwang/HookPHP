<?php
declare(strict_types=1);

namespace Base;
use Yaf\Dispatcher;

abstract class ApiController extends AbstractController
{
    public function init()
    {
        parent::init();
        Dispatcher::getInstance()->autoRender(false);
        $this->_request->setParam('version', $this->_request->action)->setActionName($this->_request->method);
    }

    public function postAction()
    {
        return $this->send($this->model->post());
    }

    public function deleteAction()
    {
        return $this->send($this->model->delete());
    }

    public function putAction()
    {
        return $this->send($this->model->put());
    }

    public function getAction()
    {
        return $this->send($this->model->get());
    }
}