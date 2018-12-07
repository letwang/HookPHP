<?php

class ConfigModel extends AbstractModel
{
    public static $table = 'hp_config';
    public $fields = [
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'value' => array('type' => parent::HTML, 'require' => true),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read(self::$table, $id, $langId);
    }
}