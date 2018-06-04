<?php
use Yaf\Session;
use Let\Http\Header, Let\Db\Db;

class LoginController extends InitController
{

    const SESSIONNAME = 'api_user_session';

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->_view->referer = $this->getRequest()->getQuery('referer', '/');
    }

    public function postAction()
    {
        $user = $this->getRequest()->getPost('user');
        $pass = $this->getRequest()->getPost('pass');
        $referer = $this->getRequest()->getPost('referer', '/');
        
        $login = Db::getInstance()->fetch(
            Let\Sql\UserLogin::SQL_TABLE_LOGIN_USER,
            [$user, $this->pass($user, $pass)]
        );
        
        if ($login) {
            Session::getInstance()->offsetSet(self::SESSIONNAME, $login);
            Header::redirect($referer);
            return true;
        }
        
        $this->_view->error = [
            '登录失败！'
        ];
    }

    public function outAction()
    {
        Session::getInstance()->del(self::SESSIONNAME);
        Header::redirect('/');
        return true;
    }

    public static function pass($user, $pass)
    {
        return strrev(md5(strrev(md5($pass . $user . $pass) . md5($pass . $pass . $user))) . md5(md5($pass . $user . $pass) . md5($pass . $pass . $user)));
    }
}
