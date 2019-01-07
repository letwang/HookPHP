<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class GroupModel extends \AbstractModel
{
    public static $table = 'hp_acl_group';
    public static $foreign = 'group_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'name' => array('type' => parent::HTML, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_GROUP, [$_SESSION[APP_NAME]['lang_id'], 1]);
    }
}