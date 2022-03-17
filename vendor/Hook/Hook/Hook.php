<?php
declare(strict_types=1);

namespace Hook\Hook;

use Hook\Db\{OrmConnect};
use Hook\Cache\Cache;

class Hook
{
    public static function getModulesForHook()
    {
        $data = &Cache::static(__METHOD__);
        if ($data === null) {
            $data = OrmConnect::getInstance()->queryAll(apcu_fetch('global')['sql']['HOOK']['MODULE']['GET_ALL'], [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP);
        }
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