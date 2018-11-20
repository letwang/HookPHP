<?php
use Hook\Http\Header;
use Yaf\Dispatcher;

abstract class AbstractController extends Yaf\Controller_Abstract
{
    public function init()
    {
        //API模块单独处理
        if ($this->_request->module === 'Api') {
            Dispatcher::getInstance()->autoRender(false);
            $this->_request->setParam('version', $this->_request->action)->setActionName($this->_request->method);
            return false;
        }
        //全局模板路径
        $this->_view->setScriptPath(APP_ROOT.($this->_request->module === 'Index' ? '' : '/modules/'.$this->_request->module).'/views/'.APP_THEME.'/');
        //全局META SEO
        $this->_view->assign(['title' => l('application.title'), 'keywords' => l('application.keywords'), 'description' => l('application.description')]);
        //登录检测
        if (!isset($_SESSION[APP_NAME])) {
            if ($this->_request->controller !== 'Login') {
                $this->forward('Login', 'index', ['referer' => $this->_request->getServer('REQUEST_URI', APP_CONFIG['http']['uri'])]);
            }
            return false;
        }
        //会话劫持
        if ($_SESSION[APP_NAME]['security']['ip'] !== $this->_request->getServer('REMOTE_ADDR') || $_SESSION[APP_NAME]['security']['agent'] !== $this->_request->getServer('HTTP_USER_AGENT')) {
            throw new Exception(l('security.hijack'));
        }
        //跨站攻击
        if (!$this->_request->isGet() && $_SESSION[APP_NAME]['security']['token'] !== $this->_request->getPost('token')) {
            throw new Exception(l('security.csrf'));
        }
        //初始化模板变量
        $this->_view->assign(['uri' => $this->_request->getRequestUri(), 'menus' => MenuModel::classify()]);
    }

    public function send($data = [], int $status = 200, int $code = 10000, string $msg = '')
    {
        Header::setCharset();
        Header::setStatus($status);
        echo json_encode(['id' => mt_rand(), 'code' => $code, 'msg' => $msg, 'data' => $data]);
    }
}