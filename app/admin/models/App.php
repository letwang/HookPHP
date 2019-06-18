<?php
use Hook\Db\{OrmConnect, PdoConnect};

class AppModel extends Base\AbstractModel
{
    public $fields = [
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'key' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'description' => array('require' => true),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Yaconf::get('sql.APP.GET_All'), [APP_LANG_ID]);
    }

    public static function getIds(): array
    {
        return OrmConnect::getInstance($this->table)->select(['key', 'id'])->where(['status' => 1])->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public static function getDefaultId(string $name = null): int
    {
        $data = self::getIds();
        return $data[$name] ?? $_SESSION[APP_NAME]['app_id'] ?? $data[APP_NAME];
    }
}