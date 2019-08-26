<?php
namespace Hook;
use Hook\Db\OrmConnect;

class ModuleModel extends \Base\AbstractModel
{
    public $fields = [
        'version' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function getSelect(): array
    {
        return OrmConnect::getInstance($this->table)->select(['id', 'key'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}