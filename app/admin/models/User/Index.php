<?php
namespace User;

use Hook\Db\PdoConnect;
use Hook\Sql\User;

class IndexModel extends \AbstractModel
{
    public static $table = 'hp_user';
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'user' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'pass' => array('type' => parent::NOTHING, 'require' => true),
        'email' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isEmail'),
        'phone' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isPhone'),
        'lastname' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'firstname' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(User::GET_ALL);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(User::GET_SHOW_SELECT, [$_SESSION[APP_NAME]['app_id'], $_SESSION[APP_NAME]['lang_id']], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}