<?php
declare(strict_types=1);

class StateController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'iso_code'],
        ['data' => 'status'],
        ['data' => 'name'],
    ];
}