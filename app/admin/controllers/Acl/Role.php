<?php
class Acl_RoleController extends BaseController
{
    public function indexAction()
    {
        $this->_view->assign(['test' => $this->_name]);
    }
}