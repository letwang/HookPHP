<?php
use Hook\Db\Table;

class LangModel extends AbstractModel
{
    public static $table = 'hp_lang';
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'iso' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isIsoCode'),
        'lang' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isLanguageCode'),
        'name' => array('type' => parent::HTML, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read(self::$table, $id, $langId);
    }

    public static function getIds(): array
    {
        return array_column(parent::read(self::$table), 'id');
    }
}