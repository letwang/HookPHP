<?php
class Hook_ModuleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['hook_id'] = $this->model->getData('hp_hook', $v['hook_id'], $this->langId)['title'];
            $v['module_id'] = $this->model->getData('hp_module', $v['module_id'])['key'];
        }
        return $this->send($data);
    }
}