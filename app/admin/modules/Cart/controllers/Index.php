<?php
class IndexController extends AbstractController
{
    public function getAction()
    {
        $this->_view->assign(
            ['test' => 'Cart']
        );
    }
}