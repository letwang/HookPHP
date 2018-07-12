<?php
namespace Hook\Http;

class Curl
{

    public $curlHandle, $fileHandle;

    public $userAgent = [
        'Mozilla/5.0 (Windows NT 6.%u; rv:31.%u) Gecko/20100101 Firefox/%u0.%u',
        'Mozilla/5.0 (Windows NT 6.%u; Trident/7.%u; rv:50.%u) like Gecko',
        'Mozilla/5.0 (Windows NT 6.%u) AppleWebKit/537.%u6 (KHTML, like Gecko) Chrome/50.%u.1%u16.153 Safari/5%u7.%u6',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_%u) AppleWebKit/5%u6.%u0 (KHTML, like Gecko) Version/6.%u Safari/5%u6.2%u',
        'Mozilla/5.0 (Windows; U; Windows NT 5.%u; en-US; rv:1.8.%u.5%u) Gecko/20080219 Firefox/2.0.%u.12 Navigator/%u.0.%u.6',
        'Opera/9.80 (Windows NT 6.%u; U; en) Presto/2.%u.%u0 Version/10.%u0'
    ];

    public $httpHeader = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.%u,*/*;q=0.%u',
        'Accept-Language: %s;q=0.%u',
        'Cache-Control: max-age=0',
        'Connection: keep-alive',
        'Pragma: no-cache'
    ];

    public $acceptLanguage = [
        'en-us,en',
        'it-ch,it',
        'sv-se,sv',
        'es-pa,es',
        'de-li,de',
        'fr-lu,fr',
        'sa-in,sa',
        'nn-no,nn',
        'ms-bn,ms'
    ];

    public $options = [
        CURLOPT_VERBOSE => false, // true is for debug
        CURLOPT_CUSTOMREQUEST => 'GET', // use get action on http
        CURLOPT_FOLLOWLOCATION => true, // auto redirect
        CURLOPT_MAXREDIRS => 10, // auto redirect max times
        CURLOPT_AUTOREFERER => true, // auto fill referer in browser header
        CURLOPT_ENCODING => '', // empty is all
        CURLOPT_RETURNTRANSFER => true, // save stream to output,not Direct echo
        CURLOPT_BINARYTRANSFER => true, // return raw result
        CURLOPT_FORBID_REUSE => true, // no cache connection
        CURLOPT_FRESH_CONNECT => true, // no cache connection
        CURLOPT_FAILONERROR => true, // show error code and catch error
        CURLOPT_SSL_VERIFYPEER => false, // disable verify to server
        CURLOPT_SSL_VERIFYHOST => 2, // verify is exists or not
        CURLOPT_TIMEOUT => 36000, // curl exec max seconds,10 h for download big file
        CURLOPT_CONNECTTIMEOUT => 0, // wait exec forever
        CURLOPT_DNS_CACHE_TIMEOUT => 36000
    ];
    // dns max seconds,10 h forever
    public function __construct(array $options = [])
    {
        $this->setCurlOptions($options);
    }

    public function __destruct()
    {
        is_resource($this->curlHandle) && curl_close($this->curlHandle);
        is_resource($this->fileHandle) && fclose($this->fileHandle);
        unset($this->curlHandle, $this->fileHandle);
    }

    public function setCurlOptions(array $options = [])
    {
        foreach ($options as $k => $v) {
            $this->options[$k] = $v; // externally set will override default
        }
    }

    public function setModeToTest()
    {
        $this->options[CURLOPT_HEADER] = false;
        $this->options[CURLOPT_NOBODY] = true;
    }

    public function setModeToHeader()
    {
        $this->options[CURLOPT_HEADER] = true;
        $this->options[CURLOPT_NOBODY] = true;
    }

    public function setModeToContent()
    {
        $this->options[CURLOPT_HEADER] = false;
        $this->options[CURLOPT_NOBODY] = false;
    }

    public function setModeToAll()
    {
        $this->options[CURLOPT_HEADER] = true;
        $this->options[CURLOPT_NOBODY] = false;
    }

    public function setUserAgent()
    {
        $this->options[CURLOPT_USERAGENT] = str_replace('%u', mt_rand(1, 9), $this->userAgent[array_rand($this->userAgent)]);
    }

    public function setHttpHeader()
    {
        $this->options[CURLOPT_HTTPHEADER] = array_map(
            function ($v) {
                return str_replace(
                    ['%s', '%u'],
                    [$this->acceptLanguage[array_rand($this->acceptLanguage)], mt_rand(1, 9)],
                    $v
                );
            },
            $this->httpHeader
        );
    }

    public function setCookie($file, array $cookie = [])
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

    public function setMultiplePagesDuringOneSession($enable = true)
    {
        $this->options[CURLOPT_COOKIESESSION] = $enable;
    }

    public function setReferer($referer)
    {
        $this->options[CURLOPT_REFERER] = $referer;
    }

    public function setAuth($username, $password)
    {
        $this->options[CURLOPT_HTTPAUTH] = CURLAUTH_ANY;
        $this->options[CURLOPT_USERPWD] = "$username:$password";
    }

    public function setProxy(array $proxy)
    {
        $this->options[CURLOPT_PROXYTYPE] = CURLPROXY_HTTP;
        $this->options[CURLOPT_PROXY] = $proxy[array_rand($proxy)];
    }

    public function setProxyMisLead()
    {
        $this->options[CURLOPT_HTTPHEADER][] = 'X-Forwarded-For: ' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
        $this->options[CURLOPT_HTTPHEADER][] = 'Client_Ip: ' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
    }

    public function setProxyAuth($username, $password)
    {
        $this->options[CURLOPT_PROXYAUTH] = CURLAUTH_ANY;
        $this->options[CURLOPT_PROXYUSERPWD] = "$username:$password";
    }

    public function setPost($post)
    {
        $this->options[CURLOPT_CUSTOMREQUEST] = 'POST';
        $this->options[CURLOPT_POST] = true;
        $this->options[CURLOPT_POSTFIELDS] = $post;
    }

    public function spider($url, $filePath = '')
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

    public function spiders(array $urlArray, array $filePathArray = [])
    {
        $result = $curlHandles = $fileHandles = [];
        $multiCurlHandles = curl_multi_init();
        $isDownLoad = ! empty($filePathArray) && array_keys($urlArray) === array_keys($filePathArray);
        
        foreach ($urlArray as $k => $url) {
            $curlHandles[$k] = curl_init($url);
            curl_setopt_array($curlHandles[$k], $this->options);
            if ($isDownLoad) {
                $fileHandles[$k] = fopen($filePathArray[$k], 'cb');
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