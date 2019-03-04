<?php
namespace Hook\Hook;

use Hook\Db\RedisConnect;
use Hook\Db\PdoConnect;
use Hook\Cache\Cache;
use Hook\Sql\Hook\Module as sqlModule;

class Hook
{
    public static function getModulesForHook()
    {
        $data = &Cache::static(__METHOD__);
        if ($data !== null) {
            return $data;
        }
        $redis = RedisConnect::getInstance()->redis;
        $key = 'cache:'.md5(sqlModule::GET_ALL);
        if (!$redis->exists($key)) {
            $data = PdoConnect::getInstance()->fetchAll(sqlModule::GET_ALL, [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP);
            $redis->set($key, $data);
            return $data;
        }
        $data = $redis->get($key);
        return $data;
    }

    public static function run($key, $args = null)
    {
        $hookModule = self::getModulesForHook();

        if (!isset($hookModule[$key])) {
            return false;
        }

        $html = '';
        foreach ($hookModule[$key] as $module) {
            $html .= call_user_func(array(Module::getInstance($module)->module, 'hook'.$key), $args);
        }
        return $html;
    }
}