<?php
declare(strict_types=1);

class Rbac_Manager_RoleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $manager = \Manager\ManagerModel::getInstance($v['manager_id'])->getData();
            $v['manager_id'] = $manager['firstname'].' '.$manager['lastname'];
            $v['role_id'] = \Rbac\RoleModel::getInstance($v['role_id'])->getData(APP_LANG_ID)['name'];
        }
        return $this->send($data);
    }
}