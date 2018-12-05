<?php
class Hook_ModuleController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Hook\ModuleModel($this->getRequest()->get('id'));
    }
    
    public function GETAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['hook_id'] = $this->model::read('hp_hook_lang', $v['hook_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['module_id'] = $this->model::read('hp_module', $v['module_id'])['key'];
        }
        return $this->send($data);
    }
    
    public function POSTAction()
    {
        return $this->send($this->model->create());
    }
    
    public function PUTAction()
    {
        return $this->send($this->model->update());
    }
    
    public function DELETEAction()
    {
        return $this->send($this->model->delete());
    }
}