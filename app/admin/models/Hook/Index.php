<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook;

class IndexModel extends \AbstractModel
{
    public static $table = 'hp_hook';
    public static $foreign = 'hook_id';

    public $fields = [
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('type' => parent::HTML, 'require' => true, 'validate' => 'isGenericName'),
        'title' => array('type' => parent::HTML, 'require' => true, 'validate' => 'isGenericName'),
        'description' => array('type' => parent::HTML, 'require' => true),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public static function get(string $table = null, int $id = 0, int $langId = 0): array
    {
        return PdoConnect::getInstance()->fetchAll(Hook::GET_ALL, [$_SESSION[APP_NAME]['lang_id']]);
    }
}