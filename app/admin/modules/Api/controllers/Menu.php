<?php
declare(strict_types=1);

class MenuController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['parent'] = \MenuModel::getInstance((int) $v['parent'])->getData(APP_LANG_ID)['name'] ?? '';
        }
        return $this->send($data);
    }
}