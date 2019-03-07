<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\Group;

class GroupModel extends \AbstractModel
{
    public static $table = 'hp_acl_group';
    public static $foreign = 'group_id';

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
        return PdoConnect::getInstance()->fetchAll(Group::GET_ALL, [$this->appId, $this->langId]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Group::GET_SHOW_SELECT, [$this->appId, $this->langId], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}