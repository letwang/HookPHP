<?php
class Acl_UserController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Acl\UserModel($this->getRequest()->getParam('id'));
    }
    
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['user_id'] = $this->model::read('hp_user', $v['user_id'])['firstname'].' '.$this->model::read('hp_user', $v['user_id'])['lastname'];
            $v['role_id'] = $this->model::read('hp_acl_role_lang', $v['role_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
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