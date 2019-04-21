<?php
class Rbac_Group_ManagerController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = $this->model->getData('hp_'.APP_NAME.'_rbac_group_lang', $v['group_id'])['name'];
            $v['manager_id'] = $this->model->getData('hp_admin_manager', $v['manager_id'])['firstname'].' '.$this->model->getData('hp_admin_manager', $v['manager_id'])['lastname'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}