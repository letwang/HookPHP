<?php
use Hook\Db\{PdoConnect, OrmConnect};
use Hook\Sql\App;

class AppModel extends Base\AbstractModel
{
    public static $table = 'hp_admin_app';
    public static $foreign = 'app_id';

    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(App::GET_All, [APP_LANG_ID]);
    }

    public static function getIds(): array
    {
        return OrmConnect::getInstance(static::$table)->select(['key', 'id'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public static function getDefaultId(string $name = null): int
    {
        $data = self::getIds();
        return $data[$name] ?? $_SESSION[APP_NAME]['app_id'] ?? $data[APP_NAME];
    }
}