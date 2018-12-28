<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class IndexModel extends \AbstractModel
{
    public static $table = 'hp_acl_group_resource';

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_GROUP_RESOURCE, [$_SESSION[APP_NAME]['lang_id'], 1]);
    }
}