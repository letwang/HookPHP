<?php
namespace Acl;
use Hook\Db\PdoConnect;
use Hook\Sql\Acl\Resource;

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

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Resource::GET_ALL, [$this->appId, $this->langId]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Resource::GET_SHOW_SELECT, [$this->appId, $this->langId], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}