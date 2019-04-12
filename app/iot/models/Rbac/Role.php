<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\Role;

class RoleModel extends \Base\AbstractModel
{
    public static $table = 'hp_'.APP_NAME.'_rbac_role';
    public static $foreign = 'role_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Role::GET_ALL, [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Role::GET_SHOW_SELECT, [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}