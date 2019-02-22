<?php
class User_IndexController extends Base\ApiController
{
    public function getAction()
    {
        $data = $this->model->get();
        foreach ($data as &$v) {
            $v['lang_id'] = $this->languages[$v['lang_id']]['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }
}