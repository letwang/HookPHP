<?php
declare(strict_types=1);

class Manager_ManagerController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        $app = array_flip(AppModel::getInstance()->getIds());
        foreach ($data as &$v) {
            $v['app_id'] = $app[$v['app_id']];
        }
        return $this->send($data);
    }
}