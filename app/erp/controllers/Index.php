<?php
class IndexController extends BaseController
{
    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'ERP']
       );
    }
}