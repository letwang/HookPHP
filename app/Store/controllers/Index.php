<?php
class IndexController extends InitController
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'Index']
        );
    }

    public function listAction()
    {
        $this->_view->assign(
            ['test' => 'List']
        );
    }
}