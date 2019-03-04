<?php
namespace Hook;
use Hook\Db\PdoConnect;
use Hook\Sql\Hook\Module;

class ModuleModel extends \AbstractModel
{
    public static $table = 'hp_hook_module';
    public $fields = [
        'hook_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'module_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
    ];

    public function __construct(int $id = null, int $langId = null)
    {
        parent::__construct($id, $langId);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Module::GET_SHOW_SELECT, [$_SESSION[APP_NAME]['app_id']], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
    }
}