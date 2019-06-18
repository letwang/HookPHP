<?php
namespace Manager;

use Hook\Db\OrmConnect;

class ManagerModel extends \Base\AbstractModel
{
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'user' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'pass' => array('type' => parent::NOTHING, 'require' => true),
        'email' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isEmail'),
        'phone' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isPhone'),
        'lastname' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'firstname' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function get(): array
    {
        return OrmConnect::getInstance($this->table)->select(['id', 'app_id', 'status', 'date_add', 'date_upd', 'user', 'email', 'phone', 'lastname', 'firstname'])->fetchAll();
    }

    public function getSelect(): array
    {
        return OrmConnect::getInstance($this->table)->select(['id', 'user'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}