<?php
use Hook\Db\{RedisConnect, PdoConnect, Table};
use Hook\Sql\Menu;
use Hook\Cache\Cache;
use Hook\Data\ArrayUtils;

class MenuModel extends AbstractModel
{
    public $table = 'hp_menu';
    public $foreign = 'menu_id';

    public function __construct()
    {
        parent::__construct();
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

    public function read(int $id = 0, int $langId = 0): array
    {
        return parent::get($this->table, $id, $langId);
    }

    public function create(): int
    {
        return parent::create();
    }

    public function update(int $id): bool
    {
        return parent::update($id);
    }

    public function delete(int $id): int
    {
        return parent::delete($id);
    }
}