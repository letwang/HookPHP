<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\Resource;

class ResourceModel extends \Base\AbstractModel
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

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Resource::GET_ALL, [APP_ID, APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Resource::GET_SHOW_SELECT, [APP_ID, APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}