<?php
use Hook\Db\{PdoConnect};
use Hook\Sql\Config;

class ConfigModel extends AbstractModel
{
    public static $table = 'hp_config';
    public $fields = [
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'value' => array('require' => true),
    ];

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(
            Config::GET_All,
            [1]
        );
    }

    public static function getDefined(): array
    {
        return PdoConnect::getInstance()->fetchAll(
            Config::GET_DEFINED,
            [1],
            PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE
        );
    }
}