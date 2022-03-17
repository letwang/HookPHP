<?php
declare(strict_types=1);

class LangController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'iso'],
        ['data' => 'lang'],
        ['data' => 'name'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}