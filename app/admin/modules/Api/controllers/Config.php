<?php
class ConfigController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new ConfigModel($this->getRequest()->getParam('id'));
    }

    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['app_id'] = AbstractModel::get('hp_app', $v['app_id'])['key'];
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
            $v['date_upd'] = date('Y-m-d H:i:s', $v['date_upd']);
        }
        return $this->send($data);
    }

    public function postAction()
    {
        return $this->send($this->model->post());
    }

    public function putAction()
    {
        return $this->send($this->model->put());
    }

    public function deleteAction()
    {
        return $this->send($this->model->delete());
    }
}