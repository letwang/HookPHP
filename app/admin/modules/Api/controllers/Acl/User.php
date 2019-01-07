<?php
class Acl_UserController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['user_id'] = $this->model->getData('hp_user', $v['user_id'])['firstname'].' '.$this->model->getData('hp_user', $v['user_id'])['lastname'];
            $v['role_id'] = $this->model->getData('hp_acl_role_lang', $v['role_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}