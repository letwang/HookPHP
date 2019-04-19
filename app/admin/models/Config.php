<?php
use Hook\Db\{OrmConnect};

class ConfigModel extends Base\AbstractModel
{
    public static $table = 'hp_'.APP_NAME.'_config';
    public $fields = [
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'value' => array('require' => true),
    ];

    public function get(): array
    {
        return OrmConnect::getInstance(static::$table)->select(['id', 'status', 'date_add', 'date_upd', 'key', 'value'])->fetchAll();
    }

    public static function getDefined(): array
    {
        return OrmConnect::getInstance(static::$table)->select(['key', 'value'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}