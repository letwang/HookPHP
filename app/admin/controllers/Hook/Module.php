<?php
class Hook_ModuleController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'hook_id' => ['data' => 'hook_id', 'className' => 'align-middle', 'title' => l('Hook_Module.hook_id')],
            'module_id' => ['data' => 'module_id', 'className' => 'align-middle', 'title' => l('Hook_Module.module_id')],
            'position' => ['data' => 'position', 'className' => 'align-middle', 'title' => l('app.position')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }

    public function getAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }

    public function postAction()
    {
        //
    }

    public function putAction()
    {
        $this->_view->assign(['id' => (int) $this->getRequest()->getParam('id')]);
    }
}