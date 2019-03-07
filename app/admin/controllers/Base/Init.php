<?php
namespace Base;
use Hook\Http\Header;

abstract class InitController extends \Yaf\Controller_Abstract
{
    protected $id;
    protected $appId;
    protected $langId;

    /**
     *
     * @var \AbstractModel
     */
    protected $model;
    protected $session;
    protected $languages;

    protected function init()
    {
        //批量注册用户自定义系统常量
        foreach (\ConfigModel::getDefined() as $key => $value) {
            defined($key) || define($key, $value);
        }

        $this->id = (int) $this->getRequest()->getParam('id');
        $this->appId = \AppModel::getIdFromName(APP_NAME);
        $this->langId = \LangModel::getIdFromName(APP_LANG_NAME);

        $class = str_replace('_', '\\', $this->_request->controller).'Model';
        $this->model = class_exists($class) ? new $class($this->id) : null;
        $this->session = $_SESSION[APP_NAME];
        $this->languages = \LangModel::getData();

        $apiModule = $this->_request->module === 'Api';
        //登录检测
        if (!isset($this->session)) {
            if ($apiModule) {
                return $this->send([], 100000, l('Login.fail'), 401);
            }
            if ($this->_request->controller !== 'Login') {
                $this->forward('Login', 'get', ['referer' => $this->_request->getServer('REQUEST_URI', APP_CONFIG['http']['uri'])]);
            }
            return false;
        }
        //会话劫持
        if ($this->session['security']['ip'] !== $this->_request->getServer('REMOTE_ADDR') || $this->session['security']['agent'] !== $this->_request->getServer('HTTP_USER_AGENT')) {
            return $this->send([], 100001, l('security.hijack'), 403);
        }
        //跨站攻击
        if (!$this->_request->isGet()) {
            mb_parse_str(file_get_contents('php://input'), $result);
            $_POST += $result;
            if ($this->session['security']['token'] !== $this->_request->getPost('token', $result['token'] ?? null)) {
                return $this->send([], 100002, l('security.csrf'), 403);
            }
        }
    }

    public static function send($data = [], int $code = 10000, string $msg = '', int $status = 200)
    {
        Header::setCharset();
        Header::setStatus($status);
        if (is_array($data)) {
            foreach ($data as &$v) {
                if (isset($v['date_add'])) {
                    $v['date_add'] = date('Y-m-d H:i:s', $v['date_add']);
                }
                if (isset($v['date_upd'])) {
                    $v['date_upd'] = date('Y-m-d H:i:s', $v['date_upd']);
                }
            }
        }
        exit(json_encode(['id' => mt_rand(), 'code' => $code, 'msg' => $msg, 'data' => $data]));
    }
}