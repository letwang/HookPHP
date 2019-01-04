<?php
class User_IndexController extends Base\ViewController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'lang_id' => ['data' => 'lang_id', 'className' => 'align-middle', 'title' => l('app.lang_id')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'user' => ['data' => 'user', 'className' => 'align-middle', 'title' => l('User_Index.user')],
            'email' => ['data' => 'email', 'className' => 'align-middle', 'title' => l('User_Index.email')],
            'phone' => ['data' => 'phone', 'className' => 'align-middle', 'title' => l('User_Index.phone')],
            'firstname' => ['data' => 'firstname', 'className' => 'align-middle', 'title' => l('User_Index.firstname')],
            'lastname' => ['data' => 'lastname', 'className' => 'align-middle', 'title' => l('User_Index.lastname')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }
}