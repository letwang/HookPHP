<?php
class Acl_IndexController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Acl\IndexModel($this->getRequest()->get('id'));
    }
    
    public function GETAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = $this->model::read('hp_acl_group_lang', $v['group_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['resource_id'] = $this->model::read('hp_acl_resource_lang', $v['resource_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
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