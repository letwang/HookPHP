<?php
namespace Hook\Hook;

use Hook\Db\{PdoConnect};
use Hook\Sql\Hook\Module as sqlModule;

class Hook
{
    public static function getModulesForHook()
    {
        return PdoConnect::getInstance()->fetchAll(sqlModule::GET_ALL, [], \PDO::FETCH_COLUMN | \PDO::FETCH_GROUP);;
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