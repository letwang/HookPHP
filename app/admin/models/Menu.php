<?php
use Hook\Db\{RedisConnect, PdoConnect};
use Hook\Sql\Menu;
use Hook\Data\ArrayUtils;

class MenuModel extends Base\AbstractModel
{
    public static $table = 'hp_menu';
    public static $foreign = 'menu_id';

    public $fields = [
        'parent' => array('type' => parent::INT, 'require' => false, 'validate' => 'isInt'),
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'url' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isUrl'),
        'icon' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('require' => true, 'validate' => 'isGenericName'),
    ];

    public function get(): array
    {
        return PdoConnect::getInstance()->fetchAll(Menu::GET_ALL, [APP_ID, APP_LANG_ID]);
    }

    public function getSelect(): array
    {
        return PdoConnect::getInstance()->fetchAll(Menu::GET_SHOW_SELECT, [APP_ID, APP_LANG_ID], PDO::FETCH_KEY_PAIR);
    }

    public static function getMenu(): array
    {
        $redis = RedisConnect::getInstance('default', 's')->redis;
        $key = 'cache:'.md5(Menu::GET_SHOW_ALL);
        if (!$redis->exists($key)) {
            $utils = new ArrayUtils();
            $utils->idKey = 'id';
            $utils->parentIdKey = 'parent';
            $data = $utils->classify(PdoConnect::getInstance()->fetchAll(Menu::GET_SHOW_ALL, [APP_ID, APP_LANG_ID]));
            $redis->set($key, $data);
            return $data;
        }
        return $redis->get($key);
    }
}