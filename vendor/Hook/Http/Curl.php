<?php
namespace Hook\Http;

class Curl
{

    public resource $curlHandle;
    public resource $fileHandle;

    public array $agent = [
        'Mozilla/5.0 (Windows NT 6.%u; rv:31.%u) Gecko/20100101 Firefox/%u0.%u',
        'Mozilla/5.0 (Windows NT 6.%u; Trident/7.%u; rv:50.%u) like Gecko',
        'Mozilla/5.0 (Windows NT 6.%u) AppleWebKit/537.%u6 (KHTML, like Gecko) Chrome/50.%u.1%u16.153 Safari/5%u7.%u6',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_%u) AppleWebKit/5%u6.%u0 (KHTML, like Gecko) Version/6.%u Safari/5%u6.2%u',
        'Mozilla/5.0 (Windows; U; Windows NT 5.%u; en-US; rv:1.8.%u.5%u) Gecko/20080219 Firefox/2.0.%u.12 Navigator/%u.0.%u.6',
        'Opera/9.80 (Windows NT 6.%u; U; en) Presto/2.%u.%u0 Version/10.%u0'
    ];

    public array $header = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.%u,*/*;q=0.%u',
        'Accept-Language: zh-CN,zh;q=0.%u,en-US;q=0.%u',
        'Connection: keep-alive',
        'Pragma: no-cache',
        'Cache-Control: no-cache',
    ];

    public array $options = [
        CURLOPT_VERBOSE => false,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_AUTOREFERER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_BINARYTRANSFER => true,
        CURLOPT_FORBID_REUSE => true,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_FAILONERROR => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_TIMEOUT => 36000,
        CURLOPT_CONNECTTIMEOUT => 0,
        CURLOPT_DNS_CACHE_TIMEOUT => 36000
    ];

    public function __construct(array $options = [])
    {
        foreach ($options as $k => $v) {
            $this->options[$k] = $v;
        }
    }

    public function __destruct()
    {
        is_resource($this->curlHandle) && curl_close($this->curlHandle);
        is_resource($this->fileHandle) && fclose($this->fileHandle);
        unset($this->curlHandle, $this->fileHandle);
    }

    public function setMode(bool $header = false, bool $noBody = false)
    {
        $this->options[CURLOPT_HEADER] = $header;
        $this->options[CURLOPT_NOBODY] = $noBody;
    }

    public function setMethod(string $method = 'GET', $value = '')
    {
        $this->options[CURLOPT_CUSTOMREQUEST] = $method;
        $this->options[CURLOPT_POSTFIELDS] = $value;
    }

    public function setReferer(string $referer = '')
    {
        $this->options[CURLOPT_REFERER] = $referer;
    }

    public function setAgent()
    {
        $this->options[CURLOPT_USERAGENT] = str_replace('%u', mt_rand(1, 9), $this->agent[array_rand($this->agent)]);
    }

    public function setHeader()
    {
        $this->options[CURLOPT_HTTPHEADER] = array_merge(str_replace('%u', mt_rand(1, 9), $this->header), $this->options[CURLOPT_HTTPHEADER] ?? []);
    }

    public function setAjax()
    {
        $this->options[CURLOPT_HTTPHEADER][] = 'X-Requested-With: XMLHttpRequest';
    }

    public function setType(string $type = 'application/json', $charset = 'utf-8')
    {
        $this->options[CURLOPT_HTTPHEADER][] = 'Content-Type: '.$type.'; charset='.$charset;
    }

    public function setIp()
    {
        $ip = mt_rand(0, 255).'.'.mt_rand(0, 255).'.'.mt_rand(0, 255).'.'.mt_rand(0, 255);
        $this->options[CURLOPT_HTTPHEADER][] = 'X-REAL-IP: '.$ip;
        $this->options[CURLOPT_HTTPHEADER][] = 'X-FORWARDED-FOR: '.$ip;
        $this->options[CURLOPT_HTTPHEADER][] = 'CLIENT-IP: '.$ip;
    }

    public function setCookie(string $file, array $cookie = [])
    {
        $this->options[CURLOPT_COOKIEJAR] = $this->options[CURLOPT_COOKIEFILE] = $file;
        $this->options[CURLOPT_COOKIE] = join(
            '; ',
            array_map(
                function (&$k, &$v) {
                    return $k . '=' . $v;
                },
                array_keys($cookie),
                $cookie
            )
        );
    }

    public function setCookieSession(bool $enable = true)
    {
        $this->options[CURLOPT_COOKIESESSION] = $enable;
    }

    public function setAuth(string $username, string $password, int $auth = CURLAUTH_BASIC)
    {
        $this->options[CURLOPT_HTTPAUTH] = $auth;
        $this->options[CURLOPT_USERPWD] = "$username:$password";
    }

    public function setProxy(array $proxy, int $type = CURLPROXY_HTTP)
    {
        $this->options[CURLOPT_PROXYTYPE] = $type;
        $this->options[CURLOPT_PROXY] = $proxy[array_rand($proxy)];
    }

    public function setProxyAuth(string $username, string $password, int $auth = CURLAUTH_BASIC)
    {
        $this->options[CURLOPT_PROXYAUTH] = $auth;
        $this->options[CURLOPT_PROXYUSERPWD] = "$username:$password";
    }

    public function spider(string $url, string $filePath = '')
    {
        $this->curlHandle = curl_init($url);
        curl_setopt_array($this->curlHandle, $this->options);
        if (is_file($filePath)) {
            $this->fileHandle = fopen($filePath, 'cb');
            curl_setopt($this->curlHandle, CURLOPT_FILE, $this->fileHandle);
        }
        
        return [
            'content' => curl_exec($this->curlHandle),
            'info' => curl_getinfo($this->curlHandle),
            'error' => curl_error($this->curlHandle)
        ];
    }

    public function spiders(array $url, array $filePath = [])
    {
        $result = $curlHandles = $fileHandles = [];
        $multiCurlHandles = curl_multi_init();
        $isDownLoad = ! empty($filePathArray) && array_keys($url) === array_keys($filePath);
        
        foreach ($url as $k => $url) {
            $curlHandles[$k] = curl_init($url);
            curl_setopt_array($curlHandles[$k], $this->options);
            if ($isDownLoad) {
                $fileHandles[$k] = fopen($filePath[$k], 'cb');
                curl_setopt($curlHandles[$k], CURLOPT_FILE, $fileHandles[$k]);
            }
            curl_multi_add_handle($multiCurlHandles, $curlHandles[$k]);
        }
        
        $process = 0;
        do {
            curl_multi_exec($multiCurlHandles, $process);
            usleep(100);
        } while ($process > 0);
        
        foreach ($curlHandles as $k => $handle) {
            $result[$k] = [
                'content' => curl_multi_getcontent($handle),
                'info' => curl_getinfo($handle),
                'error' => curl_error($handle)
            ];
            
            curl_multi_remove_handle($multiCurlHandles, $handle);
            $isDownLoad && is_resource($fileHandles[$k]) && fclose($fileHandles[$k]);
        }
        curl_multi_close($multiCurlHandles);
        unset($multiCurlHandles, $curlHandles, $fileHandles);
        return $result;
    }
}