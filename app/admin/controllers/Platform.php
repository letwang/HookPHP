<?php
class PlatformController extends BaseController
{
    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'Platform']
       );
    }
}