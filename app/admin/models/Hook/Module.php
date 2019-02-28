<?php
namespace Hook;

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
}