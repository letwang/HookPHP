<?php
namespace Acl;
use Hook\Db\OrmConnect;

class UserModel extends \Base\AbstractModel
{
    public static $table = 'hp_acl_user_role';

    public function getSelect(): array
    {
        return OrmConnect::getInstance('hp_user')->select(['id', 'user'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}