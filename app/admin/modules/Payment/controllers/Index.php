<?php
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $table = new \Hook\Db\Table('hp_acl_resource');
       // var_dump($table->desc());
       // exit();
        $this->_view->assign(
            ['test' => 'Payment']
        );
    }
}