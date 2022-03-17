<?php
declare(strict_types=1);

class Hook_Hook_ModuleController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'hook_id'],
        ['data' => 'module_id'],
        ['data' => 'position'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}