<?php
use Hook\Db\Table;

class ThemeModel extends AbstractModel
{
    public static $table = 'hp_theme';

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read(self::$table, $id, $langId);
    }
}