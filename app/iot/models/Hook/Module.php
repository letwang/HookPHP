<?php
namespace Hook;
use Hook\Db\OrmConnect;

class ModuleModel extends \Base\AbstractModel
{
    public static $table = 'hp_hook_module';
    public $fields = [
        'hook_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'module_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
    ];

    public function getSelect(): array
    {
        return OrmConnect::getInstance('hp_module')->select(['id', 'key'])->where(['app_id' => APP_ID, 'status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}