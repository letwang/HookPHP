<?php
use Hook\Db\{RedisConnect, PdoConnect};
use Hook\Sql\Menu;
use Hook\Cache\Cache;
use Hook\Data\ArrayUtils;

class MenuModel extends AbstractModel
{
    public static $table = 'hp_menu';
    public static $foreign = 'menu_id';

    public $fields = [
        'parent' => array('type' => parent::INT, 'require' => false, 'validate' => 'isInt'),
        'status' => array('type' => parent::BOOL, 'require' => true, 'validate' => 'isBool'),
        'position' => array('type' => parent::INT, 'require' => true, 'validate' => 'isInt'),
        'url' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isUrl'),
        'icon' => array('type' => parent::NOTHING, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('type' => parent::HTML, 'require' => true, 'validate' => 'isGenericName'),
    ];

    public function __construct(int $id = null, int $appId = null, int $langId = null)
    {
        parent::__construct($id, $appId, $langId);
    }

    public static function classify(): array
    {
        $data = &Cache::static(__METHOD__);
        if ($data !== null) {
            return $data;
        }
        $redis = RedisConnect::getInstance()->redis;
        $key = 'cache:'.md5(Menu::GET_ALL);
        if (!$redis->exists($key)) {
            $utils = new ArrayUtils();
            $utils->idKey = 'id';
            $utils->parentIdKey = 'parent';
            $data = $utils->classify(PdoConnect::getInstance()->fetchAll(Menu::GET_ALL));
            $redis->set($key, $data);
            return $data;
        }
        $data = $redis->get($key);
        return $data;
    }

    public function get(int $id = 0, int $langId = 0): array
    {
        return parent::read(self::$table, $id, $langId);
    }
}