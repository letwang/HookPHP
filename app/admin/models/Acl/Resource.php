<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl;

class ResourceModel extends \AbstractModel
{
    public static $table = 'hp_acl_resource';
    public static $foreign = 'resource_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'app' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'module' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'controller' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'action' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('type' => parent::HTML, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public static function get(string $table = null, int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_RESOURCE, [$_SESSION[APP_NAME]['lang_id'], 1]);
    }
}