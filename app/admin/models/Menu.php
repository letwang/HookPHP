<?php
use Hook\Db\RedisConnect;
use Hook\Db\PdoConnect;
use Hook\Sql\Menu;
use Hook\Cache\Cache;
use Hook\Data\ArrayUtils;

class MenuModel extends ObjectModel
{
    public $table = 'hp_menu';
    public $foreign = 'menu_id';

    public function __construct()
    {
        $this->validate = [];
        parent::__construct();
    }

    public static function getAll(): array
    {
        $data = &Cache::static(__METHOD__);
        if ($data !== null) {
            return $data;
        }
        $redis = RedisConnect::getInstance()->redis;
        $key = 'cache:'.md5(Menu::SQL_GET_MENUS);
        if (!$redis->exists($key)) {
            $utils = new ArrayUtils();
            $utils->idKey = 'id';
            $utils->parentIdKey = 'parent';
            $data = $utils->classify(PdoConnect::getInstance()->fetchAll(Menu::SQL_GET_MENUS));
            $redis->set($key, $data);
            return $data;
        }
        $data = $redis->get($key);
        return $data;
    }

    public function add(): int
    {
        return parent::add();
    }

    public function update(int $id): bool
    {
        return parent::update($id);
    }

    public function delete(int $id): bool
    {
        return parent::delete($id);
    }
}