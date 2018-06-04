<?php
namespace Let\Translation;

use Let\Translation\AbstractAdapter;
use Let\Translation\TranslationInterface;

class BaiduAdapter extends AbstractAdapter implements TranslationInterface
{

    public static $URL = 'http://fanyi.baidu.com/v2transapi';

    public static $LANG = [
        1 => 'zh',
        2 => 'en'
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
        
        $data = $this->spider(
            $this->url(),
            [
                'from' => self::$LANG[$this->id_lang_from],
                'to' => self::$LANG[$this->id_lang_to],
                'query' => $this->key,
                'simple_means_flag' => 3,
                'transtype' => 'realtime'
            ]
        );
        
        if (! $data['error'] && $this->format($data) === true) {
            $this->save($data);
            return $this->output(true, $data);
        }
        
        return $this->output();
    }

    private function format(&$data)
    {
        $data = json_decode($data['content']);
        
        if (json_last_error() === JSON_ERROR_NONE && $data = $data->trans_result->data[0]->dst) {
            return true;
        }
        
        return false;
    }

    private function url()
    {
        return self::$URL;
    }
}