<?php
class Acl_IndexController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = AbstractModel::get('hp_acl_group_lang', $v['group_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['resource_id'] = AbstractModel::get('hp_acl_resource_lang', $v['resource_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
        }
        return $this->send($data);
    }
}