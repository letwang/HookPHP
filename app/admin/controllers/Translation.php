<?php
declare(strict_types=1);

class TranslationController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'from'],
        ['data' => 'to'],
        ['data' => 'crc32'],
        ['data' => 'key'],
        ['data' => 'data'],
        ['data' => 'status'],
        ['data' => 'date_add'],
        ['data' => 'date_upd'],
    ];
}