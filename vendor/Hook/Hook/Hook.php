<?php
namespace Hook\Hook;
use Hook\Db\PdoConnect;
use Hook\Cache\Cache;

class Hook
{
    public function __construct()
    {
        //
    }

    public function __destruct()
    {
        //
    }

    public static function run($key, $args = null)
    {
        $hookModule = &Cache::static(__METHOD__);
        if (!$hookModule) {
            $hookModule = PdoConnect::getInstance()->fetchAll(
                \Hook\Sql\Module::SQL_GET_MODULES_FOR_HOOK, [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP
            );
        }

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