<?php
use Hook\Db\{Orm};

class ConfigModel extends AbstractModel
{
    public static $table = 'hp_config';
    public $fields = [
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'value' => array('require' => true),
    ];

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function get(): array
    {
        return Orm::getInstance('hp_config')->select(['id', 'date_add', 'date_upd', 'key', 'value'])
        ->where(['app_id' => $_SESSION[APP_NAME]['app_id']])->fetchAll();
    }
}