<?php
class ManagerController extends AbstractController
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
            'user' => ['data' => 'user', 'className' => 'align-middle', 'title' => l('Manager.user')],
            'pass' => ['data' => 'pass', 'className' => 'align-middle', 'title' => l('Manager.pass')],
            'email' => ['data' => 'email', 'className' => 'align-middle', 'title' => l('Manager.email')],
            'phone' => ['data' => 'phone', 'className' => 'align-middle', 'title' => l('Manager.phone')],
            'firstname' => ['data' => 'firstname', 'className' => 'align-middle', 'title' => l('Manager.firstname')],
            'lastname' => ['data' => 'lastname', 'className' => 'align-middle', 'title' => l('Manager.lastname')],
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