<?php
class MenuController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new MenuModel($this->getRequest()->getParam('id'));
    }

    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['app_id'] = AbstractModel::get('hp_app', $v['app_id'])['key'];
            $v['name'] = AbstractModel::get('hp_menu_lang', $v['id'], $_SESSION[APP_NAME]['lang_id'])['name'];
            $v['parent'] = AbstractModel::get('hp_menu_lang', (int) $v['parent'], $_SESSION[APP_NAME]['lang_id'])['name'] ?? '';
            $v['status'] = l('status.'.$v['status']);
            $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
            $v['date_upd'] = date('Y-m-d H:i:s', $v['date_upd']);
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