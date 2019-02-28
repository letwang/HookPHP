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
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Acl::GET_RESOURCE, [$_SESSION[APP_NAME]['app_id'], $_SESSION[APP_NAME]['lang_id']]);
    }
}