<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook;

class IndexModel extends \AbstractModel
{
    public $table = 'hp_hook';
    public $foreign = 'hook_id';

    public $fields = [
        'position' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'key' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
        'title' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
        'description' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_ALL, [$_SESSION[APP_NAME]['lang_id']]);
    }
}