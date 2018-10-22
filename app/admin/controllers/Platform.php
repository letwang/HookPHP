<?php
class PlatformController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(
            ['test' => 'Platform']
       );
    }
}