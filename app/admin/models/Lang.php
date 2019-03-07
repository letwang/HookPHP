<?php
class LangModel extends AbstractModel
{
    public static $table = 'hp_lang';
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'iso' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isIsoCode'),
        'lang' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isLanguageCode'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }

    public static function getIds(): array
    {
        return array_column(parent::getData(), 'id');
    }

    public static function getIdFromName(string $name = null): int
    {
        return array_column(parent::getData(), 'id', 'lang')[$name];
    }

    public static function getNameFromId(int $id = null): string
    {
        return array_column(parent::getData(), 'lang', 'id')[$id];
    }
}