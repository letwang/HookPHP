<?php
use Hook\Http\Header, Hook\Db\PdoConnect, Hook\Crypt\PassWord;

class LoginController extends InitController
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->_view->referer = $this->getRequest()->getParam('referer', '/');
    }

    public function postAction()
    {
        $user = $this->getRequest()->getPost('user');
        $pass = $this->getRequest()->getPost('pass');
        $referer = $this->getRequest()->getPost('referer', '/');
        
        $login = PdoConnect::getInstance()->fetch(
            Hook\Sql\Login::SQL_LOGIN,
            [$user, $user, $user]
        );
        
        if ($login && PassWord::verify($user.$pass, $login['pass'])) {
            $login['security'] = [
                'ip' => $this->getRequest()->getServer('REMOTE_ADDR'),
                'token' => md5(uniqid(mt_rand(), true)),
                'agent' => $this->getRequest()->getServer('HTTP_USER_AGENT'),
                'time' => time()
            ];

            $_SESSION = [];
            $_SESSION[APP_NAME] = $login;
            session_regenerate_id(true);

            Header::redirect($referer);
            return true;
        }
        
        $this->_view->error = [l('login.fail')];
    }

    public function outAction()
    {
        unset($_SESSION[APP_NAME]);
        session_regenerate_id(true);

        return !$this->forward('index');
    }
}