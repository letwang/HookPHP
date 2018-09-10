<?php
class IndexController extends BaseController
{
    public function indexAction()
    {
        $table = new Hook\Db\Table('hp_acl_resource');
        $this->_view->assign(
            [
                'resource' => $table->desc()
            ]
        );
    }
}