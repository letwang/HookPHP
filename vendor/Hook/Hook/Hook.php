<?php
namespace Hook\Hook;

use \Yaconf;
use Hook\Db\{PdoConnect};

class Hook
{
    public static function getModulesForHook()
    {
        return PdoConnect::getInstance()->fetchAll(Yaconf::get('sql.HOOK.MODULE.GET_ALL'), [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP);;
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