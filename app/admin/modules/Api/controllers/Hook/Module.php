<?php
class Hook_ModuleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['hook_id'] = $this->model->getData('hp_hook', $v['hook_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['module_id'] = $this->model->getData('hp_module', $v['module_id'])['key'];
        }
        return $this->send($data);
    }
}