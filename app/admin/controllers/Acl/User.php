<?php
class Acl_UserController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(['test' => $this->_name]);
    }
}