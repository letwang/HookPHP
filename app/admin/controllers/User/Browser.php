<?php
class User_BrowserController extends BaseController
{
    public function indexAction()
    {
        $this->_view->assign(['test' => $this->_name]);
    }
}