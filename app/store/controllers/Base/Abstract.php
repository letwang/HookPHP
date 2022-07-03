<?php
declare(strict_types=1);

namespace Base;

use SeasLog;
use Hook\Http\Header;

abstract class AbstractController extends \Yaf\Controller_Abstract
{
    public function init()
    {
        
    }

    public static function send(array $data = [], string $code = 'ok', int $status = 200)
    {
        Header::setCharset();
        Header::setStatus($status);
        exit(json_encode(['id' => SeasLog::getRequestID(), 'code' => $code, 'msg' => l()['error'][$code], 'data' => $data], JSON_UNESCAPED_UNICODE));
    }
}