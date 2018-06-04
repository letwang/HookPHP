<?php
namespace Let\Tools;

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

    public static function &globalStatic($key, $value = null, $reset = false)
    {
        static $data = [], $default = [];
        
        if (isset($data[$key]) || array_key_exists($key, $data)) {
            if ($reset) {
                $data[$key] = $default[$key];
            }
            
            return $data[$key];
        }
        
        if (isset($key)) {
            if ($reset) {
                return $data;
            }
            
            $data[$key] = $default[$key] = $value;
            
            return $data[$key];
        }
        
        foreach ($default as $key => $value) {
            $data[$key] = $value;
        }
        
        return $data;
    }

    public static function globalStaticRreset($key = null)
    {
        self::globalStatic($key, null, true);
    }

    public static function uploadFileIsError(array $mime, $key = 'fileData')
    {
        return (! isset($_FILES[$key]) || ! isset($_FILES[$key]['error']) || $_FILES[$key]['error'] !== 0 || ! in_array($_FILES[$key]['type'], $mime));
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
        $unit = [
            'B',
            'K',
            'M',
            'G',
            'T',
            'P'
        ];
        return number_format($bytesNumber / pow(1024, ($i = floor(log($bytesNumber, 1024)))), $decimals) . ' ' . $unit[$i];
    }

    public static function convertTime($secondsNumber, $decimals = 2)
    {
        switch (1) {
            case $secondsNumber < 1: // 1 s
                return number_format($secondsNumber, $decimals) . ' s';
            case $secondsNumber < 86400: // 1 day
                $unit = [
                    's',
                    'min',
                    'h'
                ];
                return number_format($secondsNumber / pow(60, ($i = floor(log($secondsNumber, 60)))), $decimals) . ' ' . $unit[$i];
            case $secondsNumber < 604800: // 1 week
                return number_format($secondsNumber / 86400, $decimals) . ' d';
            case $secondsNumber < 2592000: // 1 month = 30 day
                return number_format($secondsNumber / 604800, $decimals) . ' week';
            case $secondsNumber < 31536000: // 1 yr
                return number_format($secondsNumber / 2592000, $decimals) . ' month';
            case $secondsNumber >= 31536000: // >1 yr
                return number_format($secondsNumber / 31536000, $decimals) . ' yr';
        }
    }

    public static function getParamFromJson($jsonParam)
    {
        $data = json_decode($jsonParam, true);
        return $data ? '?' . http_build_query($data) : '';
    }

    public static function arrayMultiSearch(array $array, array $search, $exists = true, $strict = false)
    {
        $data = [];
        
        foreach ($array as $key => $value) {
            $flag = 1;
            
            foreach ($search as $childKey => $childValue) {
                $flag &= isset($value[$childKey]);
                
                if ($strict === false) {
                    $flag &= $value[$childKey] == $childValue;
                } else {
                    $flag &= $value[$childKey] === $childValue;
                }
            }
            
            if ($flag) {
                if ($exists === true) {
                    return [
                        $key
                    ];
                }
                
                $data[] = $key;
            }
        }
        
        return $data;
    }

    public static function cleanAndFormatInput($string, array $replace = ['-', '－'])
    {
        return array_filter(preg_replace('/\s+/isu', '', preg_split('/[' . join('|', $replace) . ']+/isu', $string)));
    }

    public static function safeSqlByBacktick($value)
    {
        return strpos($value, '`') === false ? $value : false;
    }

    public static function randomFloat($min = 0, $max = 1)
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}