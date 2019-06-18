<?php
namespace Rbac;

use \Yaconf;
use Hook\Db\{PdoConnect};

class RoleModel extends \Base\AbstractModel
{
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Yaconf::get('sql.RBAC.ROLE.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Yaconf::get('sql.RBAC.ROLE.GET_SELECT'), [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}