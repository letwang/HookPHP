<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook\Hook;

class HookModel extends \Base\AbstractModel
{
    public static $table = 'hp_'.APP_NAME.'_hook_hook';
    public static $foreign = 'hook_id';

    public $fields = [
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
        'title' => array('require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_ALL, [APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_SHOW_SELECT, [APP_LANG_ID], \PDO::FETCH_KEY_PAIR);
    }
}