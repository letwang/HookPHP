<?php
namespace Hook;
use Hook\Db\Table;

class ModuleModel extends \AbstractModel
{
    public $table = 'hp_hook_module';
    public $fields = [
        'hook_id' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'module_id' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'position' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read($this->table, $id, $langId);
    }
}