<?php
namespace Hook\Hook;

use Yaf\Registry;
use Hook\Db\{RedisConnect, PdoConnect};
use Hook\Cache\Cache;
use Hook\Sql\Hook\Module as sqlModule;

class Hook
{
    public static function getModulesForHook()
    {
        //一级缓存：单机
        if ($data = Registry::get('yac')->get('hook_module')) {
            return $data;
        }
        //二级缓存：网络
        $redis = RedisConnect::getInstance()->redis;
        $key = 'cache:hook_module';
        if ($redis->exists($key)) {
            $data = $redis->get($key);
        } else {
            $data = PdoConnect::getInstance()->fetchAll(sqlModule::GET_ALL, [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP);
            $redis->set($key, $data);
        }
        Registry::get('yac')->set('hook_module', $data);
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