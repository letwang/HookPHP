<?php
declare(strict_types=1);

class CurrencyController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'iso_code'],
        ['data' => 'numeric_iso_code'],
        ['data' => 'precision'],
        ['data' => 'conversion_rate'],
        ['data' => 'status'],
        ['data' => 'name'],
        ['data' => 'symbol'],
        ['data' => 'pattern'],
    ];
}