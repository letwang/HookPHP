<?php
class MenuController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['app_id'] = $this->model->getData('hp_app', $v['app_id'])['key'];
            $v['name'] = $this->model->getData(null, $v['id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['parent'] = $this->model->getData(null, (int) $v['parent'], $_SESSION[APP_NAME]['lang_id'])['name'] ?? '';
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}