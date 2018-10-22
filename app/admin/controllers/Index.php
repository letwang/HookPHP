<?php
class IndexController extends AbstractController
{
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