<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class GroupModel extends \AbstractModel
{
    public $table = 'hp_acl_group';
    public $foreign = 'group_id';

    public $fields = [
        'status' => array('type' => 2, 'require' => true, 'validate' => 'isGenericName'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_GROUP, [$_SESSION[APP_NAME]['lang_id'], 1]);
    }
}