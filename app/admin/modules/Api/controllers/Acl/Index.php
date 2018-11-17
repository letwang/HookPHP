<?php
class Acl_IndexController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Acl\IndexModel();
    }
    
    public function GETAction()
    {
        $data = $this->model->read();
        foreach ($data as &$v) {
            $v['group_id'] = $this->model::get('hp_acl_group_lang', $v['group_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['resource_id'] = $this->model::get('hp_acl_resource_lang', $v['resource_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
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