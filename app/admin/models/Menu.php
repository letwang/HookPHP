<?php
use Hook\Db\{RedisConnect, PdoConnect, Table};
use Hook\Sql\Menu;
use Hook\Cache\Cache;
use Hook\Data\ArrayUtils;

class MenuModel extends AbstractModel
{
    public $table = 'hp_menu';
    public $foreign = 'menu_id';

    public $fields = [
        'parent' => array('type' => 1, 'require' => false, 'validate' => 'isInt'),
        'status' => array('type' => 2, 'require' => true, 'validate' => 'isInt'),
        'position' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'date_add' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'date_upd' => array('type' => 1, 'require' => true, 'validate' => 'isInt'),
        'url' => array('type' => 6, 'require' => true, 'validate' => 'isUrl'),
        'icon' => array('type' => 6, 'require' => true, 'validate' => 'isGenericName'),
        'name' => array('type' => 5, 'require' => true, 'validate' => 'isGenericName'),
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
        return parent::read($this->table, $id, $langId);
    }
}