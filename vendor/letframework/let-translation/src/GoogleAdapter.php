<?php
namespace Let\Translation;

use Let\Translation\AbstractAdapter;
use Let\Translation\TranslationInterface;

class GoogleAdapter extends AbstractAdapter implements TranslationInterface
{

    public static $URL = 'http://translate.google.cn/translate_a/single?client=t&sl=%s&tl=%s&hl=%s&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&ie=UTF-8&oe=UTF-8&otf=1&srcrom=1&ssel=0&tsel=4&tk=%s&q=';

    public static $LANG = [
        1 => 'zh-CN',
        2 => 'en',
        3 => 'fr'
    ];

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
        $data = json_decode(preg_replace([
            '/,+/',
            '/\[,/',
            '/,]/'
        ], [
            ',',
            '[',
            ']'
        ], $data['content']));
        
        if (json_last_error() === JSON_ERROR_NONE && $data = $data[0][0][0]) {
            return true;
        }
        
        return false;
    }

    private function url()
    {
        return sprintf(self::$URL, self::$LANG[$this->id_lang_from], self::$LANG[$this->id_lang_to], self::$LANG[$this->id_lang_from], microtime(true)) . urlencode($this->key);
    }
}