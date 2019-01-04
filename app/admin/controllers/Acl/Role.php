<?php
class Acl_RoleController extends Base\ViewController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'name' => ['data' => 'name', 'className' => 'align-middle', 'title' => l('Acl_Role.name')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }
}