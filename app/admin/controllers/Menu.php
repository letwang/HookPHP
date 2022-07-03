<?php
declare(strict_types=1);

class MenuController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'icon'],
        ['data' => 'parent'],
        ['data' => 'name'],
        ['data' => 'url'],
        ['data' => 'position'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}