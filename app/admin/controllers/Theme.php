<?php
declare(strict_types=1);

class ThemeController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'key'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}