<?php
declare(strict_types=1);

class LoginController extends Base\ViewController
{
    public function getAction()
    {
        $this->_view->referer = $this->getRequest()->getParam('referer', '/');
    }
}