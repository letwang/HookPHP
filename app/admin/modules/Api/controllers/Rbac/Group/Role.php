<?php
class Rbac_Group_RoleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = $this->model->getData('hp_'.APP_NAME.'_rbac_group_lang', $v['group_id'])['name'];
            $v['role_id'] = $this->model->getData('hp_'.APP_NAME.'_rbac_role_lang', $v['role_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}