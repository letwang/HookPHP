<?php
use Hook\Db\{OrmConnect};

class ConfigModel extends Base\AbstractModel
{
    public static $table = 'hp_config';
    public $fields = [
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'value' => array('require' => true),
    ];

    public function get(): array
    {
        return OrmConnect::getInstance(static::$table)->select(['id', 'status', 'date_add', 'date_upd', 'key', 'value'])->where(['app_id' => APP_ID])->fetchAll();
    }

    public static function getDefined(): array
    {
        return OrmConnect::getInstance(static::$table)->select(['key', 'value'])->where(['app_id' => APP_ID, 'status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}