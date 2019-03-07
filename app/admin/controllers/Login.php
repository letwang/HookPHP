<?php
use Hook\Http\Header, Hook\Crypt\PassWord;
use Hook\Db\{PdoConnect, Orm};

class LoginController extends Base\ViewController
{
    public function getAction()
    {
        $this->_view->referer = $this->getRequest()->getParam('referer', '/');
    }

    public function postAction()
    {
        $user = $this->getRequest()->getPost('user');
        $pass = $this->getRequest()->getPost('pass');
        $token = $this->getRequest()->getPost('token');
        $referer = $this->getRequest()->getPost('referer', '/');
        
        $login = PdoConnect::getInstance()->fetch(
            Hook\Sql\Login::GET_MANAGER,
            [$user, $user, $user]
        );
        
        if ($login && PassWord::verify($user.$pass, $login['pass'])) {
            $login['security'] = [
                'ip' => $this->getRequest()->getServer('REMOTE_ADDR'),
                'token' => $token,
                'agent' => $this->getRequest()->getServer('HTTP_USER_AGENT'),
                'time' => time()
            ];

            $this->session = $login;
            session_regenerate_id(true);

            Header::redirect($referer);
            return true;
        }
        
        $this->_view->error = [l('Login.fail')];
    }

    public function outAction()
    {
        unset($this->session);
        session_regenerate_id(true);
        Header::redirect('/');
        return true;
    }
}