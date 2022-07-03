<?php
declare(strict_types=1);

namespace Hook\Hook;

class ModuleModel extends \Base\AbstractModel
{
    public array $fields = [
        'hook_id' => ['type' => parent::INT, 'validate' => 'isInt'],
        'module_id' => ['type' => parent::INT, 'validate' => 'isInt'],
        'position' => ['type' => parent::INT, 'validate' => 'isInt'],
    ];
}