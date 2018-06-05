<?php
class IndexController extends InitController
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $table = new \Let\Db\Table('hp_acl_resource');
       // var_dump($table->desc());
       // exit();
        $this->_view->assign(
            ['test' => '888']
        );
    }
}