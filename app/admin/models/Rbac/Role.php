<?php
namespace Rbac;

use \Yaconf;

class RoleModel extends \Base\AbstractModel
{
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
        'name' => ['required' => true, 'validate' => 'isGenericName'],
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.RBAC.ROLE.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.RBAC.ROLE.GET_SELECT'), [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}