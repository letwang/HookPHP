<?php
namespace User;

use Hook\Db\OrmConnect;

class UserModel extends \Base\AbstractModel
{
    public static $table = 'hp_user';
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
        return OrmConnect::getInstance(static::$table)->select(['id', 'status', 'date_add', 'date_upd', 'user', 'email', 'phone', 'lastname', 'firstname'])->fetchAll();
    }
}