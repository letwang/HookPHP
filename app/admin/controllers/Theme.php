<?php
class ThemeController extends AbstractController
{
    public function indexAction()
    {
        $this->_view->assign(['test' => $this->_name]);
    }
}