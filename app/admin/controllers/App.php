<?php
declare(strict_types=1);

class AppController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'key'],
        ['data' => 'title'],
        ['data' => 'description'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}