<?php
namespace Base;
use Hook\Http\Header;

abstract class AbstractController extends \Yaf\Controller_Abstract
{
    protected $id;
    protected $languages = [];

    /**
     *
     * @var \Base\AbstractModel
     */
    protected $model;

    protected function init()
    {
        $this->id = (int) $this->getRequest()->getParam('id');
        $this->languages = \LangModel::getInstance()->getData();

        $this->model = (str_replace('_', '\\', $this->_request->controller).'Model')::getInstance($this->id);

        //登录检测
        if (!isset($_SESSION[APP_NAME])) {
            if ($this->_request->module === 'Api') {
                return $this->send([], 100000, l('Login.fail'), 401);
            }
            if ($this->_request->controller !== 'Login') {
                $this->forward('Login', 'get', ['referer' => $this->_request->getServer('REQUEST_URI', APP_CONFIG['http']['uri'])]);
            }
            return false;
        }
        //会话劫持
        if ($_SESSION[APP_NAME]['security']['ip'] !== $this->_request->getServer('REMOTE_ADDR') || $_SESSION[APP_NAME]['security']['agent'] !== $this->_request->getServer('HTTP_USER_AGENT')) {
            return $this->send([], 100001, l('security.hijack'), 403);
        }
        //跨站攻击
        if (!$this->_request->isGet()) {
            mb_parse_str(file_get_contents('php://input'), $result);
            $_POST += $result;
            if ($_SESSION[APP_NAME]['security']['token'] !== $this->_request->getPost('token', $result['token'] ?? null)) {
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