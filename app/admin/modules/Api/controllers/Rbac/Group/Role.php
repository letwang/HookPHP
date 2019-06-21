<?php
class Rbac_Group_RoleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = \Rbac\GroupModel::getInstance($v['group_id'])->getData(APP_LANG_ID)['name'];
            $v['role_id'] = \Rbac\RoleModel::getInstance($v['role_id'])->getData(APP_LANG_ID)['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}