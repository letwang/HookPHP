<?php
namespace Base;
use Yaf\Dispatcher;

abstract class ApiController extends InitController
{
    protected $model;

    public function init()
    {
        parent::init();
        Dispatcher::getInstance()->autoRender(false);
        $this->_request->setParam('version', $this->_request->action)->setActionName($this->_request->method);

        $class = str_replace('_', '\\', $this->_request->controller).'Model';
        $this->model = new $class($this->getRequest()->getParam('id'));
    }

    protected function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            if (isset($v['date_add'])) {
                $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
            }
            if (isset($v['date_upd'])) {
                $v['date_upd'] = date('Y-m-d H:i:s', $v['date_upd']);
            }
        }
        return $this->send($data);
    }

    protected function postAction()
    {
        try {
            return $this->send($this->model->post());
        } catch (\Throwable $e) {
            return $this->send([], 100003, l('tips.fail'), 500);
        }
    }

    protected function putAction()
    {
        try {
            return $this->send($this->model->put());
        } catch (\Throwable $e) {
            return $this->send([], 100004, l('tips.fail'), 500);
        }
    }

    protected function deleteAction()
    {
        try {
            return $this->send($this->model->delete());
        } catch (\Throwable $e) {
            return $this->send([], 100005, l('tips.fail'), 500);
        }
    }
}