<?php
class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'Login Out']
       );
    }

    public function listAction()
    {
        $this->_view->assign(
            ['test' => 'List']
        );
    }
}