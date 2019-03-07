<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook\Hook;

class HookModel extends \AbstractModel
{
    public static $table = 'hp_hook';
    public static $foreign = 'hook_id';

    public $fields = [
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
        'title' => array('require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function __construct(int $id = null)
    {
        parent::__construct($id);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_ALL, [$this->langId]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_SHOW_SELECT, [$this->appId, $this->langId], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}