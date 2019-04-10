<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\Group;

class GroupModel extends \Base\AbstractModel
{
    public static $table = 'hp_rbac_group';
    public static $foreign = 'group_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Group::GET_ALL, [APP_ID, APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Group::GET_SHOW_SELECT, [APP_ID, APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}