<?php
class TranslationModel extends AbstractModel
{
    public static $table = 'hp_translation';

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public static function get(string $table = null, int $id = 0, int $langId = 0): array
    {
        return parent::get($table ?? self::$table, $id, $langId);
    }
}