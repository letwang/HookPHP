<?php
namespace Hook\Hook;

class ModuleModel extends \Base\AbstractModel
{
    public $fields = [
        'hook_id' => ['type' => parent::INT, 'validate' => 'isInt'],
        'module_id' => ['type' => parent::INT, 'validate' => 'isInt'],
        'position' => ['type' => parent::INT, 'validate' => 'isInt'],
    ];
}