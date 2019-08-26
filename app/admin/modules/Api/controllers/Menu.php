<?php
class MenuController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['parent'] = \MenuModel::getInstance((int) $v['parent'])->getData(APP_LANG_ID)['name'] ?? '';
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}