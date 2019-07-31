<?php
class Rbac_Group_ManagerController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = \Rbac\GroupModel::getInstance($v['group_id'])->get(APP_LANG_ID)['name'];
            $manager = \Manager\ManagerModel::getInstance($v['manager_id'])->get();
            $v['manager_id'] = $manager['firstname'].' '.$manager['lastname'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}