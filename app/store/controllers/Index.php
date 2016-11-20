<?php

class IndexController extends InitController
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        var_dump(Let\Tools\Tools::safeOutPut('Hello,Word!'));
        $this->_view->assign([
            'test' => '888'
        ]);
    }
}