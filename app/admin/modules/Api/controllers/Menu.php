<?php
class MenuController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new MenuModel();
    }

    public function GETAction()
    {
        return $this->send($this->model->read($this->model->table));
    }

    public function POSTAction()
    {
        return $this->send($this->model->add());
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