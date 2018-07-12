<?php
namespace Hook\Http;

class Header
{

    public static $httpResponseCode = [
        // INFORMATIONAL CODES
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        // REDIRECTION CODES
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        // SERVER ERROR
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        511 => 'Network Authentication Required'
    ];

    public static function callback(callable $callback)
    {
        return header_register_callback($callback);
    }

    public static function remove($name = NULL)
    {
        header_remove($name);
    }

    public static function getList()
    {
        return headers_list();
    }

    public static function isSent()
    {
        return headers_sent();
    }

    public static function redirect($url = '', $replace = true, $code = 302)
    {
        header('Location: ' . $url, $replace, $code);
    }

    public static function refresh($second = 5, $url = '')
    {
        header('refresh:' . $second . ';url=' . $url . '');
    }

    public static function viewPdf($file)
    {
        ob_start();
        header('Content-type: application/pdf');
        ob_clean();
        flush();
        readfile($file);
    }

    public static function setCharset($charset = 'utf-8')
    {
        header('Content-Type: text/html; charset=' . $charset);
    }

    public static function setPageCache($etag, $expire = 3600)
    {
        if ((isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] >= time()) && (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === $etag)) {
            self::setStatus(304);
            return true;
        }
        
        header('Last-Modified: ' . (time() + $expire));
        header('Etag: ' . $etag);
        return false;
    }

    public static function setNoCache()
    {
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public static function setStatus($code)
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $code . ' ' . self::$httpResponseCode[$code]);
    }

    public static function setCrossDomain($allow)
    {
        header('Access-Control-Allow-Origin: ' . $allow);
    }

    public static function setCookie(array $cookie = [])
    {
        foreach ($cookie as $name => $data) {
            header('Set-Cookie: ' . $name . '=' . rawurlencode(current((array) $data)) . '; Domain=.' . (isset($data['domain']) ? $data['domain'] : $_SERVER['HTTP_HOST']) . '; Max-Age=' . (isset($data['age']) ? (int) $data['age'] : 3600) . '; Path=' . (isset($data['path']) ? $data['path'] : '/') . (empty($data['secure']) ? '' : '; Secure') . (empty($data['http']) ? '' : '; HttpOnly') . '', false);
        }
    }

    public static function encrypt($account)
    {
        return md5(gzdeflate(base64_encode(md5(gzdeflate(base64_encode(md5($account))))))) . '+' . md5(gzdeflate($account));
    }

    public static function validate($account, $msg = 'Welcome to here, Pls enter the authentication key as the login.')
    {
        $_SERVER['PHP_AUTH_USER'] = $_SERVER['PHP_AUTH_PW'] = '';
        $authorization = filter_input(INPUT_SERVER, 'REDIRECT_HTTP_AUTHORIZATION') ?: filter_input(INPUT_SERVER, 'HTTP_AUTHORIZATION');
        
        $matches = [];
        if ($authorization && preg_match('/Basic\s+(.*)$/i', $authorization, $matches)) {
            list ($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode($matches[1]));
        }
        
        if ($_SERVER['PHP_AUTH_USER'] !== $account || $_SERVER['PHP_AUTH_PW'] !== self::encrypt($account)) {
            self::setStatus(401);
            header('WWW-Authenticate: Basic realm="' . $msg . '"');
            return false;
        }
        
        return true;
    }
}