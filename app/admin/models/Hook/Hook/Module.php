<?php
namespace Hook\Hook;

class ModuleModel extends \Base\AbstractModel
{
    public $fields = [
        'hook_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'module_id' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
    ];
}