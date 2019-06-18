<?php
class Rbac_Manager_RoleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['manager_id'] = $this->model->getData('%padmin_manager', $v['manager_id'])['firstname'].' '.$this->model->getData('%padmin_manager', $v['manager_id'])['lastname'];
            $v['role_id'] = $this->model->getData('%p%s_rbac_role_lang', $v['role_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}