<?php
class Acl_IndexController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new Acl\IndexModel($this->getRequest()->getParam('id'));
    }
    
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['group_id'] = $this->model::read('hp_acl_group_lang', $v['group_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['resource_id'] = $this->model::read('hp_acl_resource_lang', $v['resource_id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
        }
        return $this->send($data);
    }
    
    public function postAction()
    {
        return $this->send($this->model->post());
    }
    
    public function putAction()
    {
        return $this->send($this->model->put());
    }
    
    public function deleteAction()
    {
        return $this->send($this->model->delete());
    }
}