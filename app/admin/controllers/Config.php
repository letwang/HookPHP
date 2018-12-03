<?php
class ConfigController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->fieldsList = [
            'id' => ['data' => 'id', 'className' => 'col-checker align-middle', 'orderable' => false, 'searchable' => false],
            'app_id' => ['data' => 'app_id', 'className' => 'align-middle', 'title' => l('app.app_id')],
            'date_add' => ['data' => 'date_add', 'className' => 'align-middle', 'title' => l('app.date_add')],
            'date_upd' => ['data' => 'date_upd', 'className' => 'align-middle', 'title' => l('app.date_upd')],
            'key' => ['data' => 'key', 'className' => 'align-middle', 'title' => l('Config.key')],
            'value' => ['data' => 'value', 'className' => 'align-middle', 'title' => l('Config.value')],
            'idx' => ['data' => 'id', 'className' => 'align-middle text-right', 'orderable' => false, 'searchable' => false]
        ];
    }

    public function indexAction()
    {
        $this->_view->assign(['fieldsList' => $this->fieldsList]);
    }
}