<?php
class Acl_ResourceController extends Base\ViewController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'name' => ['data' => 'name', 'className' => 'align-middle', 'title' => l('Acl_Resource.name')],
            'app' => ['data' => 'app', 'className' => 'align-middle', 'title' => l('app.app_id')],
            'module' => ['data' => 'module', 'className' => 'align-middle', 'title' => l('Acl_Resource.module')],
            'controller' => ['data' => 'controller', 'className' => 'align-middle', 'title' => l('Acl_Resource.controller')],
            'action' => ['data' => 'action', 'className' => 'align-middle', 'title' => l('Acl_Resource.action')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }
}