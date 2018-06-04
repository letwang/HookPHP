<?php
namespace Let\Translation;

use Let\Translation\AbstractAdapter;
use Let\Translation\TranslationInterface;
use Let\Tools\Tools;

class BingAdapter extends AbstractAdapter implements TranslationInterface
{

    public static $URL = 'http://api.microsofttranslator.com/v2/ajax.svc/TranslateArray2?appId="%s"&texts=["%s"]&from="%s"&to="%s"&options={}&oncomplete=onComplete_0&onerror=onError_0&_=%s';

    public static $LANG = [
        1 => 'zh-CHS',
        2 => 'en'
    ];

    public $app_id;

    public $app_id_times = 0;

    public $app_id_times_max = 100;

    public function __construct($crawlers, $db, $table)
    {
        parent::__construct($crawlers, $db, $table);
    }

    public function get()
    {
        parent::init();
        
        $data = $this->cache();
        if ($data) {
            return $this->output(true, $data);
        }
        
        $data = $this->spider($this->url());
        
        if (! $data['error'] && $this->format($data) === true) {
            $this->save($data);
            return $this->output(true, $data);
        }
        
        return $this->output();
    }

    private function format(&$data)
    {
        $data = json_decode(
            str_replace(
                ['onComplete_0(', '﻿', ');'],
                ['', '', ''],
                $data['content']
            )
        );
        
        if (json_last_error() === JSON_ERROR_NONE && $data = $data[0]->TranslatedText) {
            return true;
        }
        
        return false;
    }

    private function url()
    {
        if (! $this->app_id) {
            $this->app_id = $this->getAPPId();
        }
        
        if ($this->app_id_times >= $this->app_id_times_max) {
            $this->app_id = $this->getAPPId();
            $this->app_id_times = 0;
        }
        
        $this->app_id_times ++;
        
        return sprintf(self::$URL, $this->app_id, urlencode($this->key), self::$LANG[$this->id_lang_from], self::$LANG[$this->id_lang_to], round(microtime(true) * 1000));
    }

    private function getAPPId()
    {
        return Tools::getStr($this->spider('http://www.bing.com/translator/dynamic/214860/js/LandingPage.js?loc=en&phenabled=&rttenabled=&v=214860')['content'], 'appId:"', '",');
    }
}