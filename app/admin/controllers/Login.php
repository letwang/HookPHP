<?php
use Hook\Http\Header, Hook\Crypt\PassWord;

class LoginController extends Base\ViewController
{
    /**
     * 
     * @var \LoginModel
     */
    protected $model;

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
        
        $login = $this->model->signIn($user);
        
        if ($login && PassWord::verify($user.$pass, $login['pass'])) {
            $login['security'] = [
                'ip' => $this->getRequest()->getServer('REMOTE_ADDR'),
                'token' => $token,
                'agent' => $this->getRequest()->getServer('HTTP_USER_AGENT'),
                'time' => time()
            ];

            $_SESSION[APP_NAME] = $login;
            session_regenerate_id(true);

            Header::redirect($referer);
            return false;
        }
        
        $this->_view->error = [l('Login.fail')];
    }

    public function outAction()
    {
        session_destroy();
        Header::redirect('/');
        return false;
    }
}