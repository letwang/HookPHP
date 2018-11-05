<?php
class AppController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'App']
       );
    }
}