<?php
class Hook_IndexController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'key' => ['data' => 'key', 'className' => 'align-middle', 'title' => l('Hook_Index.key')],
            'name' => ['data' => 'name', 'className' => 'align-middle', 'title' => l('Hook_Index.name')],
            'title' => ['data' => 'title', 'className' => 'align-middle', 'title' => l('Hook_Index.title')],
            'description' => ['data' => 'description', 'className' => 'align-middle', 'title' => l('Hook_Index.description')],
            'position' => ['data' => 'position', 'className' => 'align-middle', 'title' => l('app.position')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }

    public function indexAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }
}