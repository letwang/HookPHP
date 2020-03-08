<?php
namespace Rbac;

use \Yaconf;

class GroupModel extends \Base\AbstractModel
{
    public array $fields = [
        'status' => ['type' => parent::BOOL, 'validate' => 'isBool'],
        'name' => ['required' => true, 'validate' => 'isGenericName'],
    ];

    public function get(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.RBAC.GROUP.GET_ALL'), [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return $this->pdo->fetchAll(Yaconf::get('dicPdo.RBAC.GROUP.GET_SELECT'), [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}