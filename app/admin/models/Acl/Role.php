<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class RoleModel extends \AbstractModel
{
    public static $table = 'hp_acl_role';
    public static $foreign = 'role_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_ROLE, [$_SESSION[APP_NAME]['lang_id'], 1]);
    }
}