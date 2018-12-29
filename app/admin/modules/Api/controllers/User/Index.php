<?php
class User_IndexController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new \User\IndexModel($this->getRequest()->getParam('id'));
    }

    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['lang_id'] = AbstractModel::get('hp_lang', $v['lang_id'])['name'];
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