<?php
declare(strict_types=1);

class ConfigController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'key'],
        ['data' => 'value'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}