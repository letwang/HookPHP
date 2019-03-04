<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\User;

class UserModel extends \AbstractModel
{
    public static $table = 'hp_acl_user_role';

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(User::GET_SHOW_SELECT, [], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}