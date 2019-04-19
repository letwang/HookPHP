<?php
namespace Base;
use Hook\Http\Header;

abstract class AbstractController extends \Yaf\Controller_Abstract
{
    protected function init()
    {
        
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