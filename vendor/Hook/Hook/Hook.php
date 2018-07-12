<?php
namespace Hook\Hook;
use Hook\Db\Db;

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

    public static function run($name, $args = null)
    {
        $html = '';
        $hookModule = Db::getInstance()->fetchAll(
            \Hook\Sql\Module::SQL_GET_MODULES_FOR_HOOK,
            [$name]
        );
        foreach ($hookModule as $data) {
            $html .= call_user_func(array(self::getModuleInstance($data['module']), 'hook'.$data['hook']), $args);
        }
        return $html;
    }

    public static function getModuleInstance($module)
    {
        static $instance = null;
        if (isset($instance[$module])) {
            return $instance[$module];
        }
        require APP_PATH.'/hooks/'.$module.'/'.$module.'.php';
        return $instance[$module] = new $module;
    }
}