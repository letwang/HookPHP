<?php
class Acl_UserController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['user_id'] = AbstractModel::get('hp_user', $v['user_id'])['firstname'].' '.AbstractModel::get('hp_user', $v['user_id'])['lastname'];
            $v['role_id'] = AbstractModel::get('hp_acl_role_lang', $v['role_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
        }
        return $this->send($data);
    }
}