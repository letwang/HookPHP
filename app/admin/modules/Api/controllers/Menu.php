<?php
class MenuController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new MenuModel();
    }

    public function GETAction()
    {
        $data = $this->model->read();
        foreach ($data as &$v) {
            $v['app_id'] = $this->model::get('hp_app', $v['app_id'])['name'];
            $v['name'] = $this->model::get('hp_menu_lang', $v['id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['parent'] = $this->model::get('hp_menu_lang', (int) $v['parent'], $_SESSION[APP_NAME]['lang_id'])['name'] ?? '';
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }

    public function POSTAction()
    {
        return $this->send($this->model->add());
    }

    public function PUTAction()
    {
        $id = (int) $this->getRequest()->getPut('id');
        return $this->send($this->model->update($id));
    }

    public function DELETEAction()
    {
        $id = (int) $this->getRequest()->getDelete('id');
        return $this->send($this->model->delete($id));
    }
}