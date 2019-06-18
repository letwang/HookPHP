<?php
namespace Hook;
use Hook\Db\OrmConnect;

class ModuleModel extends \Base\AbstractModel
{
    public $fields = [
        'hook_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'module_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
    ];

    public function getSelect(): array
    {
        return OrmConnect::getInstance('%s_hook_module')->select(['id', 'key'])->where(['status' => 1])->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}