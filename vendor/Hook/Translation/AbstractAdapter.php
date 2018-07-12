<?php
namespace Hook\Translation;

use Hook\Validate\Validate;
use Hook\Translation\TranslationInterface;

abstract class AbstractAdapter implements TranslationInterface
{

    public $key, $id_lang_from, $id_lang_to;

    public $id, $key_crc32, $crawlers, $db, $table;

    public function __construct($crawlers, $db, $table)
    {
        $this->crawlers = $crawlers;
        $this->db = $db;
        $this->table = $table;
    }

    protected function init()
    {
        if (! static::$LANG[$this->id_lang_from] || ! static::$LANG[$this->id_lang_to]) {
            throw new \Exception('from ' . $this->id_lang_from . ' to ' . $this->id_lang_to);
        }
        
        $this->key_crc32 = Validate::crc32($this->key);
    }

    protected function cache()
    {
        $data = $this->db->fetch('SELECT `id`, `data` FROM `' . $this->table . '` WHERE `id_lang_from` = ' . $this->id_lang_from . ' AND `id_lang_to` = ' . $this->id_lang_to . ' AND `key_crc32` = ' . $this->key_crc32 . '');
        if ($data) {
            $this->id = (int) $data['id'];
            return $data['data'];
        }
        return false;
    }

    protected function save($data)
    {
        if (isset($this->id)) {
            return $this->db->update(
                $this->table,
                [
                    'data' => $data
                ],
                '`id` = ' . $this->id
            );
        }
        
        return $this->db->insert(
            $this->table,
            [
                'id_lang_from' => $this->id_lang_from,
                'id_lang_to' => $this->id_lang_to,
                'key_crc32' => $this->key_crc32,
                'key' => $this->key,
                'data' => $data
            ]
        );
    }

    protected function spider($url, $post = NULL)
    {
        if ($post) {
            $this->crawlers->setPost($post);
        }
        
        return $this->crawlers->spider($url);
    }

    protected function output($status = false, $data = NULL)
    {
        return json_encode(
            ['status' => $status, 'data' => $data]
        );
    }
}