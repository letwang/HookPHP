<?php
class UserController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        $app = array_flip(AppModel::getInstance()->getIds());
        foreach ($data as &$v) {
            $v['status'] = l('status.'.$v['status']);
            $v['app_id'] = $app[$v['app_id']];
        }
        return $this->send($data);
    }
}