<?php
class MenuController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new MenuModel($this->getRequest()->getParam('id'));
    }

    public function GETAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['app_id'] = $this->model::read('hp_app', $v['app_id'])['key'];
            $v['name'] = $this->model::read('hp_menu_lang', $v['id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['parent'] = $this->model::read('hp_menu_lang', (int) $v['parent'], $_SESSION[APP_NAME]['lang_id'])['name'] ?? '';
            $v['status'] = l('status.'.$v['status']);
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
            $v['date_upd'] = date('Y-m-d H:i:s', $v['date_upd']);
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