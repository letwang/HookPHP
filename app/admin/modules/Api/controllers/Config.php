<?php
class ConfigController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new ConfigModel();
    }

    public function GETAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['app_id'] = $this->model::read('hp_app', $v['app_id'])['name'];
        }
        return $this->send($data);
    }

    public function POSTAction()
    {
        return $this->send($this->model->create());
    }

    public function PUTAction()
    {
        $id = (int) $this->getRequest()->getPut('id');
        return $this->send($this->model->update($id));
    }

    public function DELETEAction()
    {
        $id = (int) $this->getRequest()->getDelete('id');
        return $this->send($this->model->delete($id));
    }
}