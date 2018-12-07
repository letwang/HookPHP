<?php
namespace Hook\Tools;

class Tools
{
    public static function getValue($key, $type = INPUT_GET, $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS, $options = [
        'options' => ['default' => '']
    ])
    {
        return filter_input($type, $key, $filter, $options);
    }

    public static function safeOutPut($string, $type = ENT_QUOTES)
    {
        if (is_array($string)) {
            return array_map(['self', 'safeOutPut'], $string);
        }
        return htmlentities((string) $string, $type, 'utf-8');
    }

    public static function safeOutPutDecode($string)
    {
        if (is_array($string)) {
            return array_map(['self', 'safeOutPutDecode'], $string);
        }
        return html_entity_decode((string) $string, ENT_QUOTES, 'utf-8');
    }

    public static function dateFormat($date, $currentFormat = 'Y-m-d H:i:s', $targetFormat = 'Y-m-d H:i:s')
    {
        $dataTime = \DateTime::createFromFormat($currentFormat, $date);
        return $dataTime ? $dataTime->format($targetFormat) : false;
    }

    public static function getStr($string, $start, $end)
    {
        if (empty($string) || empty($start) || empty($end)) {
            return '';
        }
        
        $matches = [];
        return preg_match('/' . $start . '(.*?)' . $end . '/su', $string, $matches) ? trim($matches[1]) : false;
    }

    public static function round($number, $decimals = 2, $mode = PHP_ROUND_HALF_UP)
    {
        return number_format(round($number, $decimals, $mode), $decimals, '.', '');
    }

    public static function formatUrl($url)
    {
        return str_replace([' ', '&amp;'], ['%20', '&'], $url);
    }

    public static function removeLink($string)
    {
        return preg_replace('/<a.*?>(.*?)<\/a>/isu', "\$1", $string);
    }

    public static function getUrlFromStr($string)
    {
        $matches = [];
        return preg_match_all('/<a[^>]*href\s*=\s*([\'"]?)([^\'">]*)\1(?=\s|\/|>)/isu', $string, $matches) ? (array) $matches[2] : [];
    }

    public static function getImgFromStr($string)
    {
        $matches = [];
        return preg_match_all('/<img[^>]*src\s*=\s*([\'"]?)([^\'">]*)\1(?=\s|\/|>)/isu', $string, $matches) ? (array) $matches[2] : [];
    }

    public static function convertCharset($string, $newCharset, $nowCharset = 'utf-8')
    {
        return $nowCharset !== $newCharset ? mb_convert_encoding($string, $newCharset, $nowCharset) : $string;
    }

    public static function convertSzie($bytesNumber, $decimals = 2)
    {
        $unit = ['B', 'K','M','G', 'T', 'P'];
        return number_format($bytesNumber / pow(1024, ($i = floor(log($bytesNumber, 1024)))), $decimals) . ' ' . $unit[$i];
    }

    public static function cleanAndFormatInput($string, array $replace = ['-', '－'])
    {
        return array_filter(preg_replace('/\s+/isu', '', preg_split('/[' . join('|', $replace) . ']+/isu', $string)));
    }

    public static function randomFloat($min = 0, $max = 1)
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    public static function int(&$int, $default = 0, $min = 0, $max = PHP_INT_MAX)
    {
        return isset($int) ? filter_var(
            $int,
            FILTER_VALIDATE_INT,
            ['options' => ['default' => $default, 'min_range' => $min, 'max_range' => $max]]
            ) : $default;
    }

    public static function float(&$float, $default = 0, $min = 0, $max = PHP_INT_MAX, $decimal = '.')
    {
        return isset($float) && $float >= $min && $float <= $max ? filter_var(
            $float,
            FILTER_VALIDATE_FLOAT,
            ['options' => ['default' => $default, 'decimal' => $decimal]]
            ) : $default;
    }

    public static function bool(&$bool, $default = false)
    {
        return isset($bool) ? filter_var(
            $bool,
            FILTER_VALIDATE_BOOLEAN,
            ['options' => ['default' => $default]]
            ) : $default;
    }

    public static function md5(&$md5, $default = false)
    {
        return isset($md5) && preg_match('/^[a-f0-9A-F]{32}$/', $md5) ? $md5 : $default;
    }

    public static function nl2br($str)
    {
        return isset($str) ? str_replace(
            ["\r\n", "\r", "\n"],
            '<br />',
            $str
            ) : '';
    }

    public static function ip2long(&$ip)
    {
        return sprintf('%u', ip2long($ip));
    }

    public static function crc32(&$url)
    {
        return sprintf('%u', crc32($url));
    }

    public static function mbSubstr(&$str, $length, $encoding = 'utf-8')
    {
        return isset($str) ? mb_substr($str, 0, $length, $encoding) . ($length < mb_strlen($str, $encoding) ? '...' : '') : '';
    }

    public static function url(&$url, $default = false, $flags = null)
    {
        return isset($url) ? filter_var(
            $url,
            FILTER_VALIDATE_URL,
            [
                'options' => ['default' => $default],
                'flags' => $flags ?: FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED
            ]
            ) : $default;
    }

    public static function email(&$email, $default = false)
    {
        return isset($email) ? filter_var(
            $email,
            FILTER_VALIDATE_EMAIL,
            ['options' => ['default' => $default]]
            ) : $default;
    }
}