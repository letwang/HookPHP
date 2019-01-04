<?php
class Acl_IndexController extends Base\ViewController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'group_id' => ['data' => 'group_id', 'className' => 'align-middle', 'title' => l('Acl_Index.group_id')],
            'resource_id' => ['data' => 'resource_id', 'className' => 'align-middle', 'title' => l('Acl_Index.resource_id')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }
}