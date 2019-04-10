<?php
namespace Acl;
use Hook\Db\OrmConnect;

class ManagerModel extends \Base\AbstractModel
{
    public static $table = 'hp_rbac_manager_role';

    public function getSelect(): array
    {
        return OrmConnect::getInstance('hp_manager')->select(['id', 'user'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}