<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\Role;

class RoleModel extends \AbstractModel
{
    public static $table = 'hp_acl_role';
    public static $foreign = 'role_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Role::GET_ALL, [$this->appId, $this->langId]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Role::GET_SHOW_SELECT, [$this->appId, $this->langId], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}