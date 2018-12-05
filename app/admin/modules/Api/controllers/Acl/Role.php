<?php
class Acl_RoleController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Acl\RoleModel($this->getRequest()->get('id'));
    }
    
    public function GETAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
    
    public function POSTAction()
    {
        return $this->send($this->model->create());
    }
    
    public function PUTAction()
    {
        return $this->send($this->model->update());
    }
    
    public function DELETEAction()
    {
        return $this->send($this->model->delete());
    }
}