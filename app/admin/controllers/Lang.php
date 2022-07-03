<?php
declare(strict_types=1);

class LangController extends Base\ViewController
{
    public array $cols = [
        ['data' => 'id'],
        ['data' => 'name'],
        ['data' => 'status'],
        ['data' => 'iso_code'],
        ['data' => 'language_code'],
        ['data' => 'locale'],
        ['data' => 'date_format_lite'],
        ['data' => 'date_format_full'],
        ['data' => 'is_rtl'],
    ];
}