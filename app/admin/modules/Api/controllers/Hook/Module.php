<?php
class Hook_ModuleController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['hook_id'] = $this->model->getData('%p%s_hook_hook_lang', $v['hook_id'])['title'];
            $v['module_id'] = $this->model->getData('%p%s_hook_module', $v['module_id'])['key'];
        }
        return $this->send($data);
    }
}