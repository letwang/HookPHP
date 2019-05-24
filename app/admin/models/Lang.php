<?php
use Hook\Db\OrmConnect;

class LangModel extends Base\AbstractModel
{
    public static $table = 'hp_admin_lang_i18n';
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'iso' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isIsoCode'),
        'lang' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isLanguageCode'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public static function getIds(): array
    {
        return OrmConnect::getInstance(static::$table)->select(['lang', 'id'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public static function getDefaultId(string $name = null): int
    {
        $data = self::getIds();
        return $data[$name] ?? $_SESSION[APP_NAME]['lang_id'] ?? $data[APP_LANG_NAME];
    }

    public static function getDefaultName(int $id = null): string
    {
        $data = array_flip(self::getIds());
        return $data[$id] ?? $data[APP_LANG_ID];
    }
}