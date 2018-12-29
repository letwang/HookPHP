<?php
class LangController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'name' => ['data' => 'name', 'className' => 'align-middle', 'title' => l('Lang.name')],
            'iso' => ['data' => 'iso', 'className' => 'align-middle', 'title' => l('Lang.iso')],
            'lang' => ['data' => 'lang', 'className' => 'align-middle', 'title' => l('Lang.lang')],
            'status' => ['data' => 'status', 'className' => 'align-middle', 'title' => l('app.status')],
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