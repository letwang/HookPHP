<?php
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'Payment']
        );
    }
}