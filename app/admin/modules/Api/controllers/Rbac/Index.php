<?php
declare(strict_types=1);

class Rbac_IndexController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['role_id'] = \Rbac\RoleModel::getInstance($v['role_id'])->getData(APP_LANG_ID)['name'];
            $v['type'] = l()[$this->_request->controller]['typeSelect'][$v['type']];
        }
        return $this->send($data);
    }
}