<?php
declare(strict_types=1);

class Rbac_Group_ManagerController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = \Rbac\GroupModel::getInstance($v['group_id'])->getData(APP_LANG_ID)['name'];
            $manager = \Manager\ManagerModel::getInstance($v['manager_id'])->getData();
            $v['manager_id'] = $manager['firstname'].' '.$manager['lastname'];
        }
        return $this->send($data);
    }
}