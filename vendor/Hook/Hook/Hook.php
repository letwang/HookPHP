<?php
namespace Hook\Hook;

use Yaf\Registry;
use Hook\Db\{PdoConnect};
use Hook\Sql\Hook\Module as sqlModule;

class Hook
{
    public static function getModulesForHook()
    {
        $key = 'cache:runHook';
        $callback = function(\Redis $redis) use ($key) {
            if ($redis->exists($key)) {
                return $redis->get($key);
            } else {
                $data = PdoConnect::getInstance()->fetchAll(sqlModule::GET_ALL, [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP);
                $redis->set($key, $data);
                return $data;
            }
        };

        return Registry::get('cache')->get($key, $callback);
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