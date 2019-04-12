<?php
class Rbac_ManagerController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['user_id'] = $this->model->getData('hp_manager', $v['user_id'])['firstname'].' '.$this->model->getData('hp_manager', $v['user_id'])['lastname'];
            $v['role_id'] = $this->model->getData('hp_'.APP_NAME.'_rbac_role_lang', $v['role_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}