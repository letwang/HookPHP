<?php
declare(strict_types=1);

class Hook_HookController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'key'],
        ['data' => 'title'],
        ['data' => 'description'],
        ['data' => 'position'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}