<?php
use Hook\Db\Table;

class LangModel extends AbstractModel
{
    public $table = 'hp_lang';
    public $fields = [
        'status' => array('type' => 2, 'require' => true, 'validate' => 'isInt'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'iso' => array('type' => 6, 'require' => true, 'validate' => 'isIsoCode'),
        'lang' => array('type' => 6, 'require' => true, 'validate' => 'isLanguageCode'),
        'name' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read($this->table, $id, $langId);
    }
}