<?php
class ConfigController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['app_id'] = $this->model->getData('hp_app', $v['app_id'])['key'];
        }
        return $this->send($data);
    }
}