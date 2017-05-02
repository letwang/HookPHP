<?php
use Yaf\Registry;

class IndexController extends InitController
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $table = Registry::get('Table')->init('hp_acl_role');
        var_dump($table->read());
        exit();
        $this->_view->assign([
            'test' => '888'
        ]);
    }
}