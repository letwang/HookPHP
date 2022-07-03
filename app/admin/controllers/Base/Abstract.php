<?php
declare(strict_types=1);

namespace Base;

use SeasLog;
use Hook\Http\Header;

abstract class AbstractController extends \Yaf\Controller_Abstract
{
    protected int $id;
    protected array $languages = [];

    protected object $model;

    public function init()
    {
        $this->id = (int) $this->getRequest()->getParam('id');
        $this->languages = \LangModel::getInstance()->get();

        //登录检测
        if (!isset($_SESSION[APP_NAME])) {
            if ($this->_request->module === 'Api' && $this->_request->controller !== 'Login') {
                return $this->send([], 'loginFail', 401);
            }

            if (!in_array($this->_request->controller, ['Login', 'Signup', 'Passwordreset'], true)) {
                $this->forward('Login', 'get', ['referer' => $this->_request->getServer('REQUEST_URI', APP_CONFIG['http']['uri'])]);
            }
            return false;
        }
        //会话劫持
        if ($_SESSION[APP_NAME]['security']['ip'] !== $this->_request->getServer('REMOTE_ADDR') || $_SESSION[APP_NAME]['security']['agent'] !== $this->_request->getServer('HTTP_USER_AGENT')) {
            return $this->send([], 'securityHijack', 403);
        }
        //跨站攻击
        if (!$this->_request->isGet()) {
            mb_parse_str(file_get_contents('php://input'), $result);
            $_POST += $result;
            if ($_SESSION[APP_NAME]['security']['token'] !== $this->_request->getPost('token', $result['token'] ?? null)) {
                return $this->send([], 'securityCsrf', 403);
            }
        }
    }

    public static function send(array $data = [], string $code = 'ok', int $status = 200)
    {
        Header::setCharset();
        Header::setStatus($status);
        foreach ($data as &$value) {
            isset($value['date_add']) && $value['date_add'] = date('Y-m-d H:i:s', $value['date_add']);
            isset($value['date_upd']) && $value['date_upd'] = date('Y-m-d H:i:s', $value['date_upd']);
        }
        exit(json_encode(['id' => SeasLog::getRequestID(), 'code' => $code, 'msg' => l()['error'][$code], 'data' => $data], JSON_UNESCAPED_UNICODE));
    }
}