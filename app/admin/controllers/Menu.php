<?php
class MenuController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'app_id' => ['data' => 'app_id', 'className' => 'align-middle', 'title' => l('app.app_id')],
            'parent' => ['data' => 'parent', 'className' => 'align-middle', 'title' => l('Menu.parent')],
            'url' => ['data' => 'url', 'className' => 'align-middle', 'title' => l('Menu.url')],
            'icon' => ['data' => 'icon', 'className' => 'align-middle', 'title' => l('Menu.icon')],
            'name' => ['data' => 'name', 'className' => 'align-middle', 'title' => l('Menu.name')],
            'position' => ['data' => 'position', 'className' => 'align-middle', 'title' => l('app.position')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }

    public function indexAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    public function addAction()
    {
        //
    }

    public function editAction()
    {
        $this->_view->assign(['id' => (int) $this->getRequest()->getParam('id')]);
    }
}