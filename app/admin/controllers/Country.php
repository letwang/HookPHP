<?php
declare(strict_types=1);

class CountryController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'iso_code'],
        ['data' => 'call_prefix'],
        ['data' => 'zip_code_format'],
        ['data' => 'status'],
        ['data' => 'name'],
    ];
}