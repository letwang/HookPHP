<?php
class Hook_ModuleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['hook_id'] = \Hook\HookModel::getInstance($v['hook_id'])->getData(APP_LANG_ID)['title'];
            $v['module_id'] = \Hook\ModuleModel::getInstance($v['module_id'])->getData()['key'];
        }
        return $this->send($data);
    }
}