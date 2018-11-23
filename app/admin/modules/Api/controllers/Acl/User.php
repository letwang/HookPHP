<?php
class Acl_UserController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Acl\UserModel();
    }
    
    public function GETAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['user_id'] = $this->model::read('hp_user', $v['user_id'])['firstname'].' '.$this->model::read('hp_user', $v['user_id'])['lastname'];
            $v['role_id'] = $this->model::read('hp_acl_role_lang', $v['role_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
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
        $id = (int) $this->getRequest()->getPut('id');
        return $this->send($this->model->update($id));
    }
    
    public function DELETEAction()
    {
        $id = (int) $this->getRequest()->getDelete('id');
        return $this->send($this->model->delete($id));
    }
}