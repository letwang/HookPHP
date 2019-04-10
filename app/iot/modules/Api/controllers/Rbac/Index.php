<?php
class Rbac_IndexController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = $this->model->getData('hp_rbac_group_lang', $v['group_id'])['name'];
            $v['resource_id'] = $this->model->getData('hp_rbac_resource_lang', $v['resource_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}