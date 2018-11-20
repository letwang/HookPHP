<?php
use Hook\Db\{RedisConnect, PdoConnect, Table};
use Hook\Sql\Menu;
use Hook\Cache\Cache;
use Hook\Data\ArrayUtils;

class MenuModel extends AbstractModel
{
    public $table = 'hp_menu';
    public $foreign = 'menu_id';

    public $parent;
    public $status;
    public $position;
    public $date_add;
    public $date_upd;
    public $url;
    public $icon;

    public $name;

    public $fields = [
        'parent' => array('type' => 1, 'require' => false, 'validate' => 'nl2br'),
        'status' => array('type' => 1, 'require' => true, 'validate' => 'nl2br'),
        'position' => array('type' => 3, 'require' => true, 'validate' => 'nl2br'),
        'date_add' => array('type' => 4, 'require' => true, 'validate' => 'nl2br'),
        'date_upd' => array('type' => 5, 'require' => true, 'validate' => 'nl2br'),
        'url' => array('type' => 6, 'require' => true, 'validate' => 'nl2br'),
        'icon' => array('type' => 7, 'require' => true, 'validate' => 'nl2br'),
        'name' => array('type' => 8, 'require' => true, 'validate' => 'nl2br'),
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